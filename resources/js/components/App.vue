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

        <!-- Детальная статистика -->
        <div class="detail-stats">
          <div class="detail-stat-row">
            <div class="detail-stat-icon">👑</div>
            <div class="detail-stat-body">
              <div class="detail-stat-label">Столицы</div>
              <div class="detail-stat-bar-wrap">
                <div class="detail-stat-bar" :style="{ width: (foundCapitals / Math.max(totalCapitals,1) * 100) + '%', background: '#f59e0b' }"></div>
              </div>
            </div>
            <div class="detail-stat-value">
              <strong>{{ foundCapitals }}</strong><span class="of-total"> / {{ totalCapitals }}</span>
            </div>
          </div>

          <div class="detail-stat-row">
            <div class="detail-stat-icon">🏙️</div>
            <div class="detail-stat-body">
              <div class="detail-stat-label">Города-миллионники</div>
              <div class="detail-stat-bar-wrap">
                <div class="detail-stat-bar" :style="{ width: (foundMillionaires / Math.max(totalMillionaires,1) * 100) + '%', background: '#60a5fa' }"></div>
              </div>
            </div>
            <div class="detail-stat-value">
              <strong>{{ foundMillionaires }}</strong><span class="of-total"> / {{ totalMillionaires }}</span>
            </div>
          </div>

          <div class="detail-stat-row">
            <div class="detail-stat-icon">👥</div>
            <div class="detail-stat-body">
              <div class="detail-stat-label">Охват населения</div>
              <div class="detail-stat-bar-wrap">
                <div class="detail-stat-bar" :style="{ width: populationPct + '%', background: '#4ade80' }"></div>
              </div>
              <div class="detail-stat-sub">{{ formatPop(foundPopulation) }} из {{ formatPop(totalPopulation) }}</div>
            </div>
            <div class="detail-stat-value">
              <strong>{{ populationPct }}%</strong>
            </div>
          </div>
        </div>
        <button @click="resetGame" class="start-btn">🔄 Играть снова</button>

        <div class="toggle-buttons">
          <button @click="showCountryStats = !showCountryStats" class="toggle-btn" :class="{ active: showCountryStats }">
            🌍 По странам
          </button>
          <button @click="showMissed = !showMissed" class="toggle-btn" :class="{ active: showMissed }">
            📍 Пропущенные
          </button>
        </div>
      </div>

      <!-- Country stats -->
      <div class="country-stats-list" v-if="gameState === 'finished' && showCountryStats">
        <div class="section-title">Статистика по странам</div>
        <div
          v-for="s in countryStats"
          :key="s.code"
          class="country-stat-row"
          :class="{ 'country-zero': s.found === 0 }"
        >
          <span class="country-flag">{{ getFlagEmoji(s.code) }}</span>
          <div class="country-stat-body">
            <div class="country-stat-header">
              <span class="country-stat-name">{{ s.name }}</span>
              <span class="country-stat-count" :style="{ color: s.found > 0 ? getCountryColor(s.code) : '#555' }">
                {{ s.found }}<span class="of-total"> / {{ s.total }}</span>
              </span>
            </div>
            <div class="country-stat-bar-wrap">
              <div
                class="country-stat-bar"
                :style="{
                  width: (s.found / s.total * 100) + '%',
                  background: getCountryColor(s.code)
                }"
              ></div>
            </div>
          </div>
        </div>
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
          :style="{ borderLeftColor: getCountryColor(city.country_code) }"
          @click="flyToCity(city)"
        >
          <span class="flag">{{ getFlagEmoji(city.country_code) }}</span>
          <span class="city-name-text">{{ city.name }}</span>
          <span class="city-pop-badge" :style="{ background: getCountryColor(city.country_code) + '33', color: getCountryColor(city.country_code) }">
            {{ formatPop(city.population) }}
          </span>
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
      showCountryStats: false,
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

    // ---- Post-game stats ----
    totalCapitals() {
      return this.allCities.filter(c => c.is_capital).length;
    },
    foundCapitals() {
      return this.found.filter(c => c.is_capital).length;
    },
    totalMillionaires() {
      return this.allCities.filter(c => c.population >= 1000000).length;
    },
    foundMillionaires() {
      return this.found.filter(c => c.population >= 1000000).length;
    },
    totalPopulation() {
      return this.allCities.reduce((s, c) => s + (c.population || 0), 0);
    },
    foundPopulation() {
      return this.found.reduce((s, c) => s + (c.population || 0), 0);
    },
    populationPct() {
      if (!this.totalPopulation) return 0;
      return ((this.foundPopulation / this.totalPopulation) * 100).toFixed(1);
    },

    countryStats() {
      // Build a map: country_code → { name, code, total, found }
      const map = {};
      for (const city of this.allCities) {
        const k = city.country_code;
        if (!map[k]) map[k] = { name: city.country, code: k, total: 0, found: 0 };
        map[k].total++;
      }
      for (const city of this.found) {
        if (map[city.country_code]) map[city.country_code].found++;
      }
      return Object.values(map)
        .sort((a, b) => {
          // Countries with at least one found city first, sorted by found desc
          if (b.found !== a.found) return b.found - a.found;
          return b.total - a.total;
        });
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

      L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_nolabels/{z}/{x}/{y}{r}.png', {
        attribution: '© OpenStreetMap contributors, © CARTO',
        maxZoom: 19,
        subdomains: 'abcd',
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
        const { data } = await axios.get('api/cities');
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
      this.showCountryStats = false;
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

    markerRadius(population) {
      // Logarithmic scale: radius in pixels
      // 50k → 4, 500k → 7, 3M → 10, 10M+ → 13
      if (!population) return 4;
      const r = Math.round(1.5 + Math.log10(Math.max(population, 50000)) * 2.0);
      return Math.min(Math.max(r, 4), 13);
    },

    addMarker(city, faded = false) {
      if (this.markers[city.id]) return;

      const color = faded ? '#888' : this.getCountryColor(city.country_code);
      const radius = this.markerRadius(city.population);

      const marker = L.circleMarker([city.lat, city.lng], {
        radius,
        fillColor: color,
        fillOpacity: faded ? 0.3 : 0.85,
        color: faded ? '#555' : 'rgba(255,255,255,0.75)',
        weight: faded ? 0.5 : 1.5,
        opacity: faded ? 0.5 : 1,
      })
        .addTo(this.map)
        .bindPopup(`
          <div class="popup-content">
            <strong>${city.name}</strong><br>
            <span class="flag">${this.getFlagEmoji(city.country_code)}</span> ${city.country}
            ${city.population ? `<br><small>👥 ${this.formatPop(city.population)}</small>` : ''}
          </div>
        `, { maxWidth: 200 });

      // Pop-in animation: briefly boost radius then settle
      if (!faded) {
        const big = radius * 2.2;
        marker.setRadius(big);
        setTimeout(() => marker.setRadius(radius * 1.1), 120);
        setTimeout(() => marker.setRadius(radius), 250);
      }

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
  width: 330px;
  min-width: 290px;
  background: #16213e;
  display: flex;
  flex-direction: column;
  overflow-y: auto;
  padding: 18px 16px;
  gap: 14px;
  border-right: 1px solid #0f3460;
  z-index: 10;
}

.sidebar-header {
  padding-bottom: 2px;
}

.sidebar-header h1 {
  font-size: 1.3rem;
  font-weight: 700;
  color: #e94560;
  letter-spacing: -0.01em;
}

.subtitle {
  font-size: 0.78rem;
  color: #aaa;
  margin-top: 5px;
  line-height: 1.4;
}

/* Stats */
.stats {
  display: flex;
  gap: 8px;
}

.stat-box {
  flex: 1;
  background: #0f3460;
  border-radius: 10px;
  padding: 10px 4px;
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

/* Detail stats block */
.detail-stats {
  display: flex;
  flex-direction: column;
  gap: 10px;
  background: #0f3460;
  border-radius: 10px;
  padding: 12px;
}

.detail-stat-row {
  display: flex;
  align-items: center;
  gap: 8px;
}

.detail-stat-icon {
  font-size: 1.2rem;
  width: 24px;
  text-align: center;
  flex-shrink: 0;
}

.detail-stat-body {
  flex: 1;
  min-width: 0;
}

.detail-stat-label {
  font-size: 0.72rem;
  color: #aaa;
  margin-bottom: 3px;
}

.detail-stat-bar-wrap {
  height: 6px;
  background: #1a3a6a;
  border-radius: 3px;
  overflow: hidden;
}

.detail-stat-bar {
  height: 100%;
  border-radius: 3px;
  transition: width 0.8s ease;
}

.detail-stat-sub {
  font-size: 0.65rem;
  color: #888;
  margin-top: 2px;
}

.detail-stat-value {
  font-size: 1rem;
  font-weight: 700;
  color: #e2e8f0;
  white-space: nowrap;
  text-align: right;
  min-width: 48px;
}

.of-total {
  font-size: 0.7rem;
  font-weight: 400;
  color: #888;
}

/* Toggle buttons row */
.toggle-buttons {
  display: flex;
  gap: 8px;
}

.toggle-btn {
  flex: 1;
  background: #0f3460;
  border: 1px solid #1e4d8c;
  border-radius: 8px;
  padding: 7px 6px;
  color: #aaa;
  cursor: pointer;
  font-size: 0.8rem;
  transition: all 0.2s;
  text-align: center;
}
.toggle-btn:hover { border-color: #e94560; color: #eee; }
.toggle-btn.active { background: #1e3a6a; border-color: #e94560; color: #eee; }

/* Country stats */
.section-title {
  font-size: 0.72rem;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  color: #888;
  margin-bottom: 4px;
}

.country-stats-list {
  border-top: 1px solid #0f3460;
  padding-top: 4px;
  display: flex;
  flex-direction: column;
  gap: 7px;
}

.country-stat-row {
  display: flex;
  align-items: center;
  gap: 8px;
}

.country-zero { opacity: 0.4; }

.country-flag {
  font-size: 1.05rem;
  flex-shrink: 0;
  width: 22px;
  text-align: center;
}

.country-stat-body {
  flex: 1;
  min-width: 0;
}

.country-stat-header {
  display: flex;
  justify-content: space-between;
  align-items: baseline;
  margin-bottom: 3px;
}

.country-stat-name {
  font-size: 0.8rem;
  color: #d1d5db;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 150px;
}

.country-stat-count {
  font-size: 0.8rem;
  font-weight: 700;
  flex-shrink: 0;
  margin-left: 4px;
}

.country-stat-bar-wrap {
  height: 4px;
  background: #1a3a6a;
  border-radius: 2px;
  overflow: hidden;
}

.country-stat-bar {
  height: 100%;
  border-radius: 2px;
  transition: width 0.6s ease;
  min-width: 2px;
}

/* Found / Missed lists */
.found-list, .missed-list {
  border-top: 1px solid #0f3460;
  padding-top: 10px;
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
  padding: 4px 6px 4px 10px;
  border-radius: 6px;
  cursor: pointer;
  font-size: 0.85rem;
  display: flex;
  align-items: center;
  gap: 6px;
  transition: background 0.15s;
  border-left: 3px solid transparent;
}
.found-city:hover { background: #0f3460; }
.found-city { color: #e2e8f0; }
.city-name-text { flex: 1; min-width: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
.city-pop-badge {
  font-size: 0.65rem;
  padding: 1px 5px;
  border-radius: 8px;
  white-space: nowrap;
  flex-shrink: 0;
}
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

/* Leaflet circleMarker hover */
.leaflet-interactive:hover {
  cursor: pointer;
}

/* Leaflet popup */
.popup-content { font-size: 13px; line-height: 1.6; }
.popup-content strong { font-size: 14px; }

/* Scrollbar */
::-webkit-scrollbar { width: 5px; }
::-webkit-scrollbar-track { background: #0f3460; }
::-webkit-scrollbar-thumb { background: #e94560; border-radius: 3px; }
</style>
