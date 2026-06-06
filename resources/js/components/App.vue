<template>
  <div class="game-wrapper">
    <!-- Sidebar -->
    <div class="sidebar">
      <div class="sidebar-header">
        <h1>🌍 Города Европы</h1>
        <p class="subtitle">Введи название города — он появится на карте</p>
      </div>

      <!-- Timer & Score -->
      <div class="stats">
        <div class="stat-box">
          <div class="stat-value" :class="{ 'time-low': timeLeft < 60 }">{{ formatTime(timeLeft) }}</div>
          <div class="stat-label">Осталось</div>
        </div>
        <div class="stat-box">
          <div class="stat-value score-value">{{ found.length }}</div>
          <div class="stat-label">из {{ totalCities }}</div>
        </div>
        <div class="stat-box">
          <div class="stat-value">{{ Math.round((found.length / Math.max(totalCities, 1)) * 100) }}%</div>
          <div class="stat-label">Процент</div>
        </div>
      </div>

      <!-- Progress bar -->
      <div class="progress-bar-wrap">
        <div class="progress-bar" :style="{ width: progressPct + '%' }"></div>
      </div>

      <!-- Input -->
      <div class="input-section" v-if="gameState === 'playing'">
        <div class="input-row">
          <input
            ref="cityInput"
            v-model="inputValue"
            @input="handleInput"
            @keydown.enter="submitCity"
            placeholder="Введи название города..."
            class="city-input"
            :class="{ 'input-error': inputError, 'input-success': inputSuccess }"
            autocomplete="off"
            spellcheck="false"
          />
          <button @click="submitCity" class="submit-btn">→</button>
        </div>
        <div class="input-hint" v-if="lastMessage">{{ lastMessage }}</div>
      </div>

      <!-- Start / End screens -->
      <div class="start-screen" v-if="gameState === 'idle'">
        <div class="mode-selector">
          <label>Режим игры:</label>
          <div class="mode-buttons">
            <button
              v-for="mode in modes"
              :key="mode.value"
              @click="selectedMode = mode.value"
              :class="{ active: selectedMode === mode.value }"
              class="mode-btn"
            >{{ mode.label }}</button>
          </div>
        </div>
        <button @click="startGame" class="start-btn" :disabled="loading">
          <span v-if="loading">Загрузка...</span>
          <span v-else>▶ Начать игру</span>
        </button>
      </div>

      <div class="end-screen" v-if="gameState === 'finished'">
        <div class="result-title">Игра окончена!</div>
        <div class="result-stats">
          <div>Угадано: <strong>{{ found.length }}</strong> из <strong>{{ totalCities }}</strong></div>
          <div>Процент: <strong>{{ Math.round((found.length / Math.max(totalCities, 1)) * 100) }}%</strong></div>
        </div>
        <div class="result-grade" :class="gradeClass">{{ grade }}</div>
        <button @click="resetGame" class="start-btn">🔄 Играть снова</button>
        <button @click="showMissed = !showMissed" class="show-missed-btn">
          {{ showMissed ? 'Скрыть' : 'Показать' }} пропущенные города
        </button>
      </div>

      <!-- Missed cities list -->
      <div class="missed-list" v-if="gameState === 'finished' && showMissed">
        <div
          v-for="city in missedCities.slice(0, 50)"
          :key="city.id"
          class="missed-city"
          @click="flyToCity(city)"
        >
          <span class="flag">{{ getFlagEmoji(city.country_code) }}</span>
          {{ city.name }}
          <small>{{ city.country }}</small>
        </div>
        <div v-if="missedCities.length > 50" class="more-cities">
          ...и ещё {{ missedCities.length - 50 }} городов
        </div>
      </div>

      <!-- Found cities list -->
      <div class="found-list" v-if="gameState === 'playing' && found.length > 0">
        <div class="found-list-title">Угаданные ({{ found.length }}):</div>
        <div
          v-for="city in [...found].reverse().slice(0, 20)"
          :key="city.id"
          class="found-city"
          @click="flyToCity(city)"
        >
          <span class="flag">{{ getFlagEmoji(city.country_code) }}</span>
          {{ city.name }}
        </div>
      </div>

      <!-- Give up button -->
      <button v-if="gameState === 'playing'" @click="giveUp" class="give-up-btn">
        Сдаться
      </button>
    </div>

    <!-- Map -->
    <div class="map-container">
      <div id="europe-map" ref="mapEl"></div>
    </div>
  </div>
</template>

<script>
import L from 'leaflet';
import axios from 'axios';

// Fix leaflet default marker icons
delete L.Icon.Default.prototype._getIconUrl;
L.Icon.Default.mergeOptions({
  iconRetinaUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png',
  iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
  shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
});

const MODES = [
  { value: 600, label: '10 мин' },
  { value: 300, label: '5 мин' },
  { value: 900, label: '15 мин' },
  { value: 0, label: 'Без лимита' },
];

export default {
  name: 'App',

  data() {
    return {
      map: null,
      allCities: [],
      citiesMap: {},      // lowercase name → city object
      found: [],
      foundIds: new Set(),
      markers: {},
      loading: false,
      gameState: 'idle',  // idle | playing | finished
      inputValue: '',
      lastMessage: '',
      inputError: false,
      inputSuccess: false,
      timeLeft: 600,
      timer: null,
      selectedMode: 600,
      modes: MODES,
      showMissed: false,
    };
  },

  computed: {
    totalCities() {
      return this.allCities.length;
    },
    progressPct() {
      if (!this.totalCities) return 0;
      return (this.found.length / this.totalCities) * 100;
    },
    missedCities() {
      return this.allCities.filter(c => !this.foundIds.has(c.id));
    },
    grade() {
      const pct = (this.found.length / Math.max(this.totalCities, 1)) * 100;
      if (pct >= 80) return '🏆 Отлично!';
      if (pct >= 60) return '🎉 Хорошо!';
      if (pct >= 40) return '👍 Неплохо!';
      if (pct >= 20) return '🙂 Продолжай!';
      return '💪 Попробуй ещё!';
    },
    gradeClass() {
      const pct = (this.found.length / Math.max(this.totalCities, 1)) * 100;
      if (pct >= 80) return 'grade-gold';
      if (pct >= 60) return 'grade-silver';
      if (pct >= 40) return 'grade-bronze';
      return 'grade-normal';
    },
  },

  async mounted() {
    this.initMap();
    await this.loadCities();
  },

  beforeUnmount() {
    this.stopTimer();
  },

  methods: {
    initMap() {
      this.map = L.map(this.$refs.mapEl, {
        center: [54, 15],
        zoom: 4,
        minZoom: 3,
        maxZoom: 12,
      });

      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
        maxZoom: 19,
      }).addTo(this.map);

      // Europe bounds
      const europeBounds = L.latLngBounds(
        L.latLng(27, -32),
        L.latLng(81, 65)
      );
      this.map.setMaxBounds(europeBounds.pad(0.2));
    },

    async loadCities() {
      this.loading = true;
      try {
        const { data } = await axios.get('/api/cities');
        this.allCities = data;
        this.citiesMap = {};
        data.forEach(city => {
          // Index by Russian name (normalized)
          const key = this.normalize(city.name);
          this.citiesMap[key] = city;

          // Also index alternate forms (without hyphens, etc.)
          const altKey = key.replace(/-/g, ' ');
          if (altKey !== key) this.citiesMap[altKey] = city;
        });
      } catch (e) {
        console.error('Failed to load cities', e);
      } finally {
        this.loading = false;
      }
    },

    normalize(str) {
      return str
        .toLowerCase()
        .trim()
        .replace(/ё/g, 'е')
        .replace(/\s+/g, ' ');
    },

    startGame() {
      this.found = [];
      this.foundIds = new Set();
      this.clearMarkers();
      this.inputValue = '';
      this.lastMessage = '';
      this.timeLeft = this.selectedMode;
      this.gameState = 'playing';
      this.showMissed = false;
      this.$nextTick(() => {
        this.$refs.cityInput?.focus();
        this.startTimer();
      });
    },

    resetGame() {
      this.stopTimer();
      this.clearMarkers();
      this.found = [];
      this.foundIds = new Set();
      this.inputValue = '';
      this.lastMessage = '';
      this.showMissed = false;
      this.gameState = 'idle';
    },

    giveUp() {
      this.stopTimer();
      this.finishGame();
    },

    finishGame() {
      this.gameState = 'finished';
      this.stopTimer();
      // Show all missed cities as faded markers
      this.allCities.forEach(city => {
        if (!this.foundIds.has(city.id)) {
          this.addMarker(city, true);
        }
      });
    },

    startTimer() {
      if (this.selectedMode === 0) return; // No limit
      this.timer = setInterval(() => {
        this.timeLeft--;
        if (this.timeLeft <= 0) {
          this.timeLeft = 0;
          this.finishGame();
        }
      }, 1000);
    },

    stopTimer() {
      if (this.timer) {
        clearInterval(this.timer);
        this.timer = null;
      }
    },

    handleInput() {
      this.inputError = false;
      this.inputSuccess = false;
    },

    submitCity() {
      const value = this.inputValue.trim();
      if (!value) return;

      const key = this.normalize(value);
      const city = this.citiesMap[key];

      if (!city) {
        this.showError('❌ Такой город не найден в Европе');
        return;
      }

      if (this.foundIds.has(city.id)) {
        this.showError('✓ Этот город уже угадан!');
        return;
      }

      // Correct!
      this.foundIds.add(city.id);
      this.found.push(city);
      this.addMarker(city, false);
      this.flyToCity(city);

      this.inputValue = '';
      this.showSuccess(`✓ ${city.name}, ${city.country}`);
    },

    showError(msg) {
      this.lastMessage = msg;
      this.inputError = true;
      this.inputSuccess = false;
      setTimeout(() => {
        this.inputError = false;
        this.lastMessage = '';
      }, 1500);
    },

    showSuccess(msg) {
      this.lastMessage = msg;
      this.inputSuccess = true;
      this.inputError = false;
      setTimeout(() => {
        this.inputSuccess = false;
        this.lastMessage = '';
      }, 2000);
    },

    addMarker(city, faded = false) {
      if (this.markers[city.id]) return;

      const color = faded ? '#999' : this.getCountryColor(city.country_code);

      const icon = L.divIcon({
        className: '',
        html: `<div class="city-dot ${faded ? 'city-dot-missed' : 'city-dot-found'}" style="background:${color}"></div>`,
        iconSize: [10, 10],
        iconAnchor: [5, 5],
      });

      const marker = L.marker([city.lat, city.lng], { icon })
        .addTo(this.map)
        .bindPopup(`
          <div class="popup-content">
            <strong>${city.name}</strong><br>
            <span class="flag">${this.getFlagEmoji(city.country_code)}</span> ${city.country}
            ${city.population ? `<br><small>👥 ${this.formatPop(city.population)}</small>` : ''}
          </div>
        `, { maxWidth: 200 });

      this.markers[city.id] = marker;
    },

    clearMarkers() {
      Object.values(this.markers).forEach(m => this.map.removeLayer(m));
      this.markers = {};
    },

    flyToCity(city) {
      this.map.flyTo([city.lat, city.lng], 7, { duration: 0.8 });
      if (this.markers[city.id]) {
        this.markers[city.id].openPopup();
      }
    },

    formatTime(seconds) {
      if (this.selectedMode === 0) return '∞';
      const m = Math.floor(seconds / 60).toString().padStart(2, '0');
      const s = (seconds % 60).toString().padStart(2, '0');
      return `${m}:${s}`;
    },

    formatPop(n) {
      if (n >= 1000000) return (n / 1000000).toFixed(1) + ' млн';
      if (n >= 1000) return Math.round(n / 1000) + ' тыс';
      return n;
    },

    getFlagEmoji(code) {
      if (!code || code === 'XK') return '🏳';
      const offset = 127397;
      return [...code.toUpperCase()].map(c => String.fromCodePoint(c.charCodeAt(0) + offset)).join('');
    },

    getCountryColor(code) {
      const palette = {
        RU: '#e63946', UA: '#f4d03f', DE: '#3498db', FR: '#2ecc71',
        GB: '#9b59b6', IT: '#e67e22', ES: '#e74c3c', PL: '#1abc9c',
        NL: '#ff6b35', BE: '#f1c40f', CH: '#e74c3c', AT: '#c0392b',
        SE: '#16a085', NO: '#2980b9', DK: '#d35400', FI: '#27ae60',
        RO: '#8e44ad', HU: '#2c3e50', CZ: '#7f8c8d', SK: '#95a5a6',
        BY: '#d35400', PT: '#27ae60', GR: '#3498db', BG: '#e74c3c',
        RS: '#2980b9', HR: '#c0392b', SI: '#16a085', EE: '#f39c12',
        LV: '#8e44ad', LT: '#27ae60', MD: '#d35400', IE: '#2ecc71',
        IS: '#3498db', TR: '#e74c3c',
      };
      return palette[code] || '#34495e';
    },
  },
};
</script>

<style>
* { box-sizing: border-box; margin: 0; padding: 0; }

body {
  font-family: 'Segoe UI', system-ui, sans-serif;
  background: #1a1a2e;
  color: #eee;
  height: 100vh;
  overflow: hidden;
}

.game-wrapper {
  display: flex;
  height: 100vh;
}

/* ---- Sidebar ---- */
.sidebar {
  width: 320px;
  min-width: 280px;
  background: #16213e;
  display: flex;
  flex-direction: column;
  overflow-y: auto;
  padding: 16px;
  gap: 12px;
  border-right: 1px solid #0f3460;
  z-index: 10;
}

.sidebar-header h1 {
  font-size: 1.3rem;
  font-weight: 700;
  color: #e94560;
}

.subtitle {
  font-size: 0.78rem;
  color: #aaa;
  margin-top: 4px;
}

/* Stats */
.stats {
  display: flex;
  gap: 8px;
}

.stat-box {
  flex: 1;
  background: #0f3460;
  border-radius: 8px;
  padding: 8px 4px;
  text-align: center;
}

.stat-value {
  font-size: 1.4rem;
  font-weight: 700;
  color: #e94560;
}

.stat-value.score-value { color: #4ade80; }
.stat-value.time-low { color: #f59e0b; animation: pulse 1s infinite; }

@keyframes pulse {
  0%, 100% { opacity: 1; }
  50% { opacity: 0.5; }
}

.stat-label {
  font-size: 0.65rem;
  color: #aaa;
  text-transform: uppercase;
}

/* Progress bar */
.progress-bar-wrap {
  height: 4px;
  background: #0f3460;
  border-radius: 2px;
  overflow: hidden;
}

.progress-bar {
  height: 100%;
  background: linear-gradient(90deg, #e94560, #4ade80);
  transition: width 0.5s ease;
}

/* Input section */
.input-row {
  display: flex;
  gap: 8px;
}

.city-input {
  flex: 1;
  background: #0f3460;
  border: 2px solid #1e4d8c;
  border-radius: 8px;
  padding: 10px 12px;
  color: #eee;
  font-size: 0.95rem;
  outline: none;
  transition: border-color 0.2s;
}

.city-input:focus { border-color: #e94560; }
.city-input.input-error { border-color: #ef4444; background: #3b1a1a; }
.city-input.input-success { border-color: #4ade80; background: #1a3b1a; }
.city-input::placeholder { color: #666; }

.submit-btn {
  background: #e94560;
  border: none;
  border-radius: 8px;
  padding: 10px 14px;
  color: white;
  font-size: 1.1rem;
  cursor: pointer;
  transition: background 0.2s;
}
.submit-btn:hover { background: #c73652; }

.input-hint {
  font-size: 0.8rem;
  padding: 4px 2px;
  color: #aaa;
  min-height: 20px;
}

/* Start screen */
.mode-selector { display: flex; flex-direction: column; gap: 6px; font-size: 0.85rem; color: #aaa; }
.mode-buttons { display: flex; gap: 6px; flex-wrap: wrap; }
.mode-btn {
  flex: 1;
  background: #0f3460;
  border: 2px solid #1e4d8c;
  border-radius: 6px;
  padding: 6px 4px;
  color: #eee;
  cursor: pointer;
  font-size: 0.8rem;
  transition: all 0.2s;
  white-space: nowrap;
}
.mode-btn.active { background: #e94560; border-color: #e94560; }
.mode-btn:hover { border-color: #e94560; }

.start-btn {
  background: linear-gradient(135deg, #e94560, #c73652);
  border: none;
  border-radius: 10px;
  padding: 14px;
  color: white;
  font-size: 1.1rem;
  font-weight: 600;
  cursor: pointer;
  width: 100%;
  transition: opacity 0.2s;
}
.start-btn:hover { opacity: 0.9; }
.start-btn:disabled { opacity: 0.5; cursor: not-allowed; }

/* End screen */
.result-title { font-size: 1.2rem; font-weight: 700; color: #e94560; text-align: center; }
.result-stats { font-size: 0.9rem; color: #ccc; line-height: 1.8; text-align: center; }
.result-grade {
  font-size: 1.3rem;
  font-weight: 700;
  text-align: center;
  padding: 8px;
  border-radius: 8px;
}
.grade-gold { color: #fbbf24; }
.grade-silver { color: #9ca3af; }
.grade-bronze { color: #d97706; }
.grade-normal { color: #60a5fa; }

.show-missed-btn {
  background: #0f3460;
  border: 1px solid #1e4d8c;
  border-radius: 8px;
  padding: 8px;
  color: #aaa;
  cursor: pointer;
  width: 100%;
  font-size: 0.85rem;
  transition: all 0.2s;
  margin-top: -4px;
}
.show-missed-btn:hover { border-color: #e94560; color: #eee; }

/* Found / Missed lists */
.found-list, .missed-list {
  border-top: 1px solid #0f3460;
  padding-top: 8px;
  max-height: 250px;
  overflow-y: auto;
}

.found-list-title {
  font-size: 0.75rem;
  color: #888;
  text-transform: uppercase;
  margin-bottom: 6px;
}

.found-city, .missed-city {
  padding: 4px 6px;
  border-radius: 6px;
  cursor: pointer;
  font-size: 0.85rem;
  display: flex;
  align-items: center;
  gap: 6px;
  transition: background 0.15s;
}
.found-city:hover { background: #0f3460; }
.found-city { color: #4ade80; }
.missed-city { color: #9ca3af; }
.missed-city:hover { background: #0f3460; color: #eee; }
.missed-city small { margin-left: auto; font-size: 0.7rem; color: #666; }

.more-cities { font-size: 0.75rem; color: #666; text-align: center; padding: 4px; }

.give-up-btn {
  margin-top: auto;
  background: transparent;
  border: 1px solid #555;
  border-radius: 8px;
  padding: 8px;
  color: #888;
  cursor: pointer;
  font-size: 0.8rem;
  transition: all 0.2s;
}
.give-up-btn:hover { border-color: #e94560; color: #e94560; }

/* ---- Map ---- */
.map-container {
  flex: 1;
  position: relative;
}

#europe-map {
  width: 100%;
  height: 100%;
}

/* Markers */
.city-dot {
  width: 10px;
  height: 10px;
  border-radius: 50%;
  border: 2px solid white;
  box-shadow: 0 0 6px rgba(0,0,0,0.5);
  transition: transform 0.2s;
}

.city-dot-found {
  box-shadow: 0 0 8px rgba(255, 255, 255, 0.6);
  animation: pop 0.4s ease-out;
}

.city-dot-missed {
  opacity: 0.45;
  border-color: #666;
}

@keyframes pop {
  0% { transform: scale(0); }
  70% { transform: scale(1.4); }
  100% { transform: scale(1); }
}

/* Leaflet popup */
.popup-content { font-size: 13px; line-height: 1.6; }
.popup-content strong { font-size: 14px; }

/* Scrollbar */
::-webkit-scrollbar { width: 5px; }
::-webkit-scrollbar-track { background: #0f3460; }
::-webkit-scrollbar-thumb { background: #e94560; border-radius: 3px; }
</style>
