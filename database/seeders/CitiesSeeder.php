<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesSeeder extends Seeder
{
    public function run(): void
    {
        $cities = [
            // Россия
            ['name' => 'Москва', 'name_en' => 'moscow', 'lat' => 55.7558, 'lng' => 37.6176, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 12506468],
            ['name' => 'Санкт-Петербург', 'name_en' => 'saint petersburg', 'lat' => 59.9343, 'lng' => 30.3351, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 5351935],
            ['name' => 'Новосибирск', 'name_en' => 'novosibirsk', 'lat' => 54.9884, 'lng' => 82.9357, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 1621000],
            ['name' => 'Екатеринбург', 'name_en' => 'ekaterinburg', 'lat' => 56.8389, 'lng' => 60.6057, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 1495066],
            ['name' => 'Казань', 'name_en' => 'kazan', 'lat' => 55.7879, 'lng' => 49.1221, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 1257391],
            ['name' => 'Нижний Новгород', 'name_en' => 'nizhny novgorod', 'lat' => 56.3269, 'lng' => 44.0065, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 1244254],
            ['name' => 'Самара', 'name_en' => 'samara', 'lat' => 53.2028, 'lng' => 50.1408, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 1163399],
            ['name' => 'Омск', 'name_en' => 'omsk', 'lat' => 54.9885, 'lng' => 73.3242, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 1154507],
            ['name' => 'Ростов-на-Дону', 'name_en' => 'rostov-on-don', 'lat' => 47.2357, 'lng' => 39.7015, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 1137904],
            ['name' => 'Уфа', 'name_en' => 'ufa', 'lat' => 54.7388, 'lng' => 55.9721, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 1128787],
            ['name' => 'Красноярск', 'name_en' => 'krasnoyarsk', 'lat' => 56.0184, 'lng' => 92.8672, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 1095286],
            ['name' => 'Воронеж', 'name_en' => 'voronezh', 'lat' => 51.6720, 'lng' => 39.1843, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 1058261],
            ['name' => 'Пермь', 'name_en' => 'perm', 'lat' => 58.0105, 'lng' => 56.2502, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 1055397],
            ['name' => 'Волгоград', 'name_en' => 'volgograd', 'lat' => 48.7194, 'lng' => 44.5018, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 1008998],
            ['name' => 'Краснодар', 'name_en' => 'krasnodar', 'lat' => 45.0448, 'lng' => 38.9760, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 932629],
            ['name' => 'Саратов', 'name_en' => 'saratov', 'lat' => 51.5924, 'lng' => 45.9608, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 838042],
            ['name' => 'Тюмень', 'name_en' => 'tyumen', 'lat' => 57.1522, 'lng' => 65.5272, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 807271],
            ['name' => 'Тольятти', 'name_en' => 'tolyatti', 'lat' => 53.5303, 'lng' => 49.3461, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 702879],
            ['name' => 'Ижевск', 'name_en' => 'izhevsk', 'lat' => 56.8527, 'lng' => 53.2114, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 646468],
            ['name' => 'Барнаул', 'name_en' => 'barnaul', 'lat' => 53.3548, 'lng' => 83.7695, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 632809],
            ['name' => 'Калининград', 'name_en' => 'kaliningrad', 'lat' => 54.7065, 'lng' => 20.5110, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 475056],
            ['name' => 'Архангельск', 'name_en' => 'arkhangelsk', 'lat' => 64.5401, 'lng' => 40.5433, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 336028],
            ['name' => 'Мурманск', 'name_en' => 'murmansk', 'lat' => 68.9585, 'lng' => 33.0827, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 282452],
            ['name' => 'Сочи', 'name_en' => 'sochi', 'lat' => 43.6028, 'lng' => 39.7342, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 443562],
            ['name' => 'Астрахань', 'name_en' => 'astrakhan', 'lat' => 46.3479, 'lng' => 48.0326, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 529793],
            ['name' => 'Псков', 'name_en' => 'pskov', 'lat' => 57.8194, 'lng' => 28.3314, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 209426],
            ['name' => 'Великий Новгород', 'name_en' => 'veliky novgorod', 'lat' => 58.5213, 'lng' => 31.2754, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 219970],
            ['name' => 'Владикавказ', 'name_en' => 'vladikavkaz', 'lat' => 43.0481, 'lng' => 44.6672, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 311869],
            ['name' => 'Грозный', 'name_en' => 'grozny', 'lat' => 43.3187, 'lng' => 45.6986, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 327637],
            ['name' => 'Махачкала', 'name_en' => 'makhachkala', 'lat' => 42.9849, 'lng' => 47.5047, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 619777],
            ['name' => 'Смоленск', 'name_en' => 'smolensk', 'lat' => 54.7818, 'lng' => 32.0401, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 326905],
            ['name' => 'Тверь', 'name_en' => 'tver', 'lat' => 56.8587, 'lng' => 35.9176, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 420350],
            ['name' => 'Ярославль', 'name_en' => 'yaroslavl', 'lat' => 57.6261, 'lng' => 39.8845, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 603960],
            ['name' => 'Иваново', 'name_en' => 'ivanovo', 'lat' => 57.0004, 'lng' => 40.9739, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 406497],
            ['name' => 'Владимир', 'name_en' => 'vladimir', 'lat' => 56.1290, 'lng' => 40.4066, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 354010],
            ['name' => 'Рязань', 'name_en' => 'ryazan', 'lat' => 54.6269, 'lng' => 39.6916, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 529736],
            ['name' => 'Брянск', 'name_en' => 'bryansk', 'lat' => 53.2434, 'lng' => 34.3640, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 403943],
            ['name' => 'Курск', 'name_en' => 'kursk', 'lat' => 51.7304, 'lng' => 36.1927, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 443249],
            ['name' => 'Орёл', 'name_en' => 'oryol', 'lat' => 52.9651, 'lng' => 36.0785, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 300643],
            ['name' => 'Белгород', 'name_en' => 'belgorod', 'lat' => 50.5958, 'lng' => 36.5873, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 392592],
            ['name' => 'Тула', 'name_en' => 'tula', 'lat' => 54.1961, 'lng' => 37.6182, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 468303],
            ['name' => 'Калуга', 'name_en' => 'kaluga', 'lat' => 54.5293, 'lng' => 36.2754, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 326083],
            ['name' => 'Петрозаводск', 'name_en' => 'petrozavodsk', 'lat' => 61.7849, 'lng' => 34.3469, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 272460],
            ['name' => 'Сыктывкар', 'name_en' => 'syktyvkar', 'lat' => 61.6688, 'lng' => 50.8360, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 255719],
            ['name' => 'Нарьян-Мар', 'name_en' => 'naryan-mar', 'lat' => 67.6380, 'lng' => 53.0062, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 24521],
            ['name' => 'Пенза', 'name_en' => 'penza', 'lat' => 53.1959, 'lng' => 45.0186, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 524498],
            ['name' => 'Ульяновск', 'name_en' => 'ulyanovsk', 'lat' => 54.3170, 'lng' => 48.4024, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 616047],
            ['name' => 'Чебоксары', 'name_en' => 'cheboksary', 'lat' => 56.1439, 'lng' => 47.2489, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 497618],
            ['name' => 'Саранск', 'name_en' => 'saransk', 'lat' => 54.1875, 'lng' => 45.1836, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 319768],
            ['name' => 'Йошкар-Ола', 'name_en' => 'yoshkar-ola', 'lat' => 56.6279, 'lng' => 47.8989, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 277623],
            ['name' => 'Нальчик', 'name_en' => 'nalchik', 'lat' => 43.4848, 'lng' => 43.6087, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 238867],
            ['name' => 'Ставрополь', 'name_en' => 'stavropol', 'lat' => 45.0431, 'lng' => 41.9734, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 461177],
            ['name' => 'Черкесск', 'name_en' => 'cherkessk', 'lat' => 44.2278, 'lng' => 42.0570, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 129562],
            ['name' => 'Майкоп', 'name_en' => 'maykop', 'lat' => 44.6076, 'lng' => 40.1086, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 139558],
            ['name' => 'Элиста', 'name_en' => 'elista', 'lat' => 46.3073, 'lng' => 44.2685, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 105225],
            ['name' => 'Липецк', 'name_en' => 'lipetsk', 'lat' => 52.6031, 'lng' => 39.5708, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 510441],
            ['name' => 'Тамбов', 'name_en' => 'tambov', 'lat' => 52.7319, 'lng' => 41.4629, 'country' => 'Россия', 'country_code' => 'RU', 'population' => 290334],

            // Германия
            ['name' => 'Берлин', 'name_en' => 'berlin', 'lat' => 52.5200, 'lng' => 13.4050, 'country' => 'Германия', 'country_code' => 'DE', 'population' => 3677472],
            ['name' => 'Гамбург', 'name_en' => 'hamburg', 'lat' => 53.5753, 'lng' => 10.0153, 'country' => 'Германия', 'country_code' => 'DE', 'population' => 1852478],
            ['name' => 'Мюнхен', 'name_en' => 'munich', 'lat' => 48.1351, 'lng' => 11.5820, 'country' => 'Германия', 'country_code' => 'DE', 'population' => 1484226],
            ['name' => 'Кёльн', 'name_en' => 'cologne', 'lat' => 50.9333, 'lng' => 6.9500, 'country' => 'Германия', 'country_code' => 'DE', 'population' => 1084394],
            ['name' => 'Франкфурт-на-Майне', 'name_en' => 'frankfurt', 'lat' => 50.1109, 'lng' => 8.6821, 'country' => 'Германия', 'country_code' => 'DE', 'population' => 763380],
            ['name' => 'Штутгарт', 'name_en' => 'stuttgart', 'lat' => 48.7758, 'lng' => 9.1829, 'country' => 'Германия', 'country_code' => 'DE', 'population' => 634830],
            ['name' => 'Дюссельдорф', 'name_en' => 'dusseldorf', 'lat' => 51.2217, 'lng' => 6.7762, 'country' => 'Германия', 'country_code' => 'DE', 'population' => 619294],
            ['name' => 'Лейпциг', 'name_en' => 'leipzig', 'lat' => 51.3397, 'lng' => 12.3731, 'country' => 'Германия', 'country_code' => 'DE', 'population' => 587857],
            ['name' => 'Дортмунд', 'name_en' => 'dortmund', 'lat' => 51.5139, 'lng' => 7.4653, 'country' => 'Германия', 'country_code' => 'DE', 'population' => 588250],
            ['name' => 'Эссен', 'name_en' => 'essen', 'lat' => 51.4508, 'lng' => 7.0131, 'country' => 'Германия', 'country_code' => 'DE', 'population' => 579432],
            ['name' => 'Бремен', 'name_en' => 'bremen', 'lat' => 53.0793, 'lng' => 8.8017, 'country' => 'Германия', 'country_code' => 'DE', 'population' => 567559],
            ['name' => 'Дрезден', 'name_en' => 'dresden', 'lat' => 51.0504, 'lng' => 13.7373, 'country' => 'Германия', 'country_code' => 'DE', 'population' => 554649],
            ['name' => 'Ганновер', 'name_en' => 'hannover', 'lat' => 52.3759, 'lng' => 9.7320, 'country' => 'Германия', 'country_code' => 'DE', 'population' => 535932],
            ['name' => 'Нюрнберг', 'name_en' => 'nuremberg', 'lat' => 49.4521, 'lng' => 11.0767, 'country' => 'Германия', 'country_code' => 'DE', 'population' => 515543],
            ['name' => 'Дуйсбург', 'name_en' => 'duisburg', 'lat' => 51.4344, 'lng' => 6.7623, 'country' => 'Германия', 'country_code' => 'DE', 'population' => 495885],
            ['name' => 'Бохум', 'name_en' => 'bochum', 'lat' => 51.4818, 'lng' => 7.2162, 'country' => 'Германия', 'country_code' => 'DE', 'population' => 364742],
            ['name' => 'Вупперталь', 'name_en' => 'wuppertal', 'lat' => 51.2562, 'lng' => 7.1508, 'country' => 'Германия', 'country_code' => 'DE', 'population' => 354382],
            ['name' => 'Бонн', 'name_en' => 'bonn', 'lat' => 50.7359, 'lng' => 7.0982, 'country' => 'Германия', 'country_code' => 'DE', 'population' => 333007],
            ['name' => 'Мюнстер', 'name_en' => 'munster', 'lat' => 51.9607, 'lng' => 7.6261, 'country' => 'Германия', 'country_code' => 'DE', 'population' => 315293],
            ['name' => 'Карлсруэ', 'name_en' => 'karlsruhe', 'lat' => 49.0069, 'lng' => 8.4037, 'country' => 'Германия', 'country_code' => 'DE', 'population' => 313092],
            ['name' => 'Мангейм', 'name_en' => 'mannheim', 'lat' => 49.4878, 'lng' => 8.4660, 'country' => 'Германия', 'country_code' => 'DE', 'population' => 310658],
            ['name' => 'Аугсбург', 'name_en' => 'augsburg', 'lat' => 48.3717, 'lng' => 10.8983, 'country' => 'Германия', 'country_code' => 'DE', 'population' => 296582],
            ['name' => 'Висбаден', 'name_en' => 'wiesbaden', 'lat' => 50.0782, 'lng' => 8.2398, 'country' => 'Германия', 'country_code' => 'DE', 'population' => 278342],
            ['name' => 'Гельзенкирхен', 'name_en' => 'gelsenkirchen', 'lat' => 51.5177, 'lng' => 7.0857, 'country' => 'Германия', 'country_code' => 'DE', 'population' => 262528],
            ['name' => 'Мёнхенгладбах', 'name_en' => 'monchengladbach', 'lat' => 51.1805, 'lng' => 6.4428, 'country' => 'Германия', 'country_code' => 'DE', 'population' => 261454],
            ['name' => 'Аахен', 'name_en' => 'aachen', 'lat' => 50.7753, 'lng' => 6.0839, 'country' => 'Германия', 'country_code' => 'DE', 'population' => 245885],

            // Франция
            ['name' => 'Париж', 'name_en' => 'paris', 'lat' => 48.8566, 'lng' => 2.3522, 'country' => 'Франция', 'country_code' => 'FR', 'population' => 2148000],
            ['name' => 'Марсель', 'name_en' => 'marseille', 'lat' => 43.2965, 'lng' => 5.3698, 'country' => 'Франция', 'country_code' => 'FR', 'population' => 861635],
            ['name' => 'Лион', 'name_en' => 'lyon', 'lat' => 45.7640, 'lng' => 4.8357, 'country' => 'Франция', 'country_code' => 'FR', 'population' => 516092],
            ['name' => 'Тулуза', 'name_en' => 'toulouse', 'lat' => 43.6047, 'lng' => 1.4442, 'country' => 'Франция', 'country_code' => 'FR', 'population' => 479553],
            ['name' => 'Ницца', 'name_en' => 'nice', 'lat' => 43.7102, 'lng' => 7.2620, 'country' => 'Франция', 'country_code' => 'FR', 'population' => 342522],
            ['name' => 'Нант', 'name_en' => 'nantes', 'lat' => 47.2184, 'lng' => -1.5536, 'country' => 'Франция', 'country_code' => 'FR', 'population' => 309346],
            ['name' => 'Монпелье', 'name_en' => 'montpellier', 'lat' => 43.6119, 'lng' => 3.8772, 'country' => 'Франция', 'country_code' => 'FR', 'population' => 285121],
            ['name' => 'Страсбург', 'name_en' => 'strasbourg', 'lat' => 48.5734, 'lng' => 7.7521, 'country' => 'Франция', 'country_code' => 'FR', 'population' => 284677],
            ['name' => 'Бордо', 'name_en' => 'bordeaux', 'lat' => 44.8378, 'lng' => -0.5792, 'country' => 'Франция', 'country_code' => 'FR', 'population' => 254436],
            ['name' => 'Лилль', 'name_en' => 'lille', 'lat' => 50.6292, 'lng' => 3.0573, 'country' => 'Франция', 'country_code' => 'FR', 'population' => 232741],
            ['name' => 'Ренн', 'name_en' => 'rennes', 'lat' => 48.1173, 'lng' => -1.6778, 'country' => 'Франция', 'country_code' => 'FR', 'population' => 215366],
            ['name' => 'Реймс', 'name_en' => 'reims', 'lat' => 49.2628, 'lng' => 4.0347, 'country' => 'Франция', 'country_code' => 'FR', 'population' => 182460],
            ['name' => 'Тур', 'name_en' => 'tours', 'lat' => 47.3941, 'lng' => 0.6848, 'country' => 'Франция', 'country_code' => 'FR', 'population' => 136565],
            ['name' => 'Гренобль', 'name_en' => 'grenoble', 'lat' => 45.1885, 'lng' => 5.7245, 'country' => 'Франция', 'country_code' => 'FR', 'population' => 158180],
            ['name' => 'Дижон', 'name_en' => 'dijon', 'lat' => 47.3220, 'lng' => 5.0415, 'country' => 'Франция', 'country_code' => 'FR', 'population' => 155090],
            ['name' => 'Гавр', 'name_en' => 'le havre', 'lat' => 49.4938, 'lng' => 0.1077, 'country' => 'Франция', 'country_code' => 'FR', 'population' => 172074],
            ['name' => 'Амьен', 'name_en' => 'amiens', 'lat' => 49.8941, 'lng' => 2.2958, 'country' => 'Франция', 'country_code' => 'FR', 'population' => 133448],
            ['name' => 'Перпиньян', 'name_en' => 'perpignan', 'lat' => 42.6887, 'lng' => 2.8948, 'country' => 'Франция', 'country_code' => 'FR', 'population' => 120959],
            ['name' => 'Клермон-Ферран', 'name_en' => 'clermont-ferrand', 'lat' => 45.7797, 'lng' => 3.0863, 'country' => 'Франция', 'country_code' => 'FR', 'population' => 142823],
            ['name' => 'Брест', 'name_en' => 'brest', 'lat' => 48.3904, 'lng' => -4.4861, 'country' => 'Франция', 'country_code' => 'FR', 'population' => 140064],
            ['name' => 'Орлеан', 'name_en' => 'orleans', 'lat' => 47.9029, 'lng' => 1.9090, 'country' => 'Франция', 'country_code' => 'FR', 'population' => 114644],

            // Великобритания
            ['name' => 'Лондон', 'name_en' => 'london', 'lat' => 51.5074, 'lng' => -0.1278, 'country' => 'Великобритания', 'country_code' => 'GB', 'population' => 8982000],
            ['name' => 'Бирмингем', 'name_en' => 'birmingham', 'lat' => 52.4862, 'lng' => -1.8904, 'country' => 'Великобритания', 'country_code' => 'GB', 'population' => 1144900],
            ['name' => 'Манчестер', 'name_en' => 'manchester', 'lat' => 53.4808, 'lng' => -2.2426, 'country' => 'Великобритания', 'country_code' => 'GB', 'population' => 553230],
            ['name' => 'Глазго', 'name_en' => 'glasgow', 'lat' => 55.8642, 'lng' => -4.2518, 'country' => 'Великобритания', 'country_code' => 'GB', 'population' => 635130],
            ['name' => 'Ливерпуль', 'name_en' => 'liverpool', 'lat' => 53.4084, 'lng' => -2.9916, 'country' => 'Великобритания', 'country_code' => 'GB', 'population' => 498042],
            ['name' => 'Эдинбург', 'name_en' => 'edinburgh', 'lat' => 55.9533, 'lng' => -3.1883, 'country' => 'Великобритания', 'country_code' => 'GB', 'population' => 524930],
            ['name' => 'Лидс', 'name_en' => 'leeds', 'lat' => 53.8008, 'lng' => -1.5491, 'country' => 'Великобритания', 'country_code' => 'GB', 'population' => 793139],
            ['name' => 'Бристоль', 'name_en' => 'bristol', 'lat' => 51.4545, 'lng' => -2.5879, 'country' => 'Великобритания', 'country_code' => 'GB', 'population' => 470600],
            ['name' => 'Шеффилд', 'name_en' => 'sheffield', 'lat' => 53.3811, 'lng' => -1.4701, 'country' => 'Великобритания', 'country_code' => 'GB', 'population' => 584853],
            ['name' => 'Кардифф', 'name_en' => 'cardiff', 'lat' => 51.4816, 'lng' => -3.1791, 'country' => 'Великобритания', 'country_code' => 'GB', 'population' => 362756],
            ['name' => 'Белфаст', 'name_en' => 'belfast', 'lat' => 54.5973, 'lng' => -5.9301, 'country' => 'Великобритания', 'country_code' => 'GB', 'population' => 341877],
            ['name' => 'Ноттингем', 'name_en' => 'nottingham', 'lat' => 52.9548, 'lng' => -1.1581, 'country' => 'Великобритания', 'country_code' => 'GB', 'population' => 321500],
            ['name' => 'Ньюкасл', 'name_en' => 'newcastle', 'lat' => 54.9783, 'lng' => -1.6178, 'country' => 'Великобритания', 'country_code' => 'GB', 'population' => 302820],
            ['name' => 'Лестер', 'name_en' => 'leicester', 'lat' => 52.6369, 'lng' => -1.1398, 'country' => 'Великобритания', 'country_code' => 'GB', 'population' => 368600],
            ['name' => 'Ковентри', 'name_en' => 'coventry', 'lat' => 52.4081, 'lng' => -1.5106, 'country' => 'Великобритания', 'country_code' => 'GB', 'population' => 367700],
            ['name' => 'Абердин', 'name_en' => 'aberdeen', 'lat' => 57.1497, 'lng' => -2.0943, 'country' => 'Великобритания', 'country_code' => 'GB', 'population' => 228800],
            ['name' => 'Оксфорд', 'name_en' => 'oxford', 'lat' => 51.7520, 'lng' => -1.2577, 'country' => 'Великобритания', 'country_code' => 'GB', 'population' => 162100],
            ['name' => 'Кембридж', 'name_en' => 'cambridge', 'lat' => 52.2053, 'lng' => 0.1218, 'country' => 'Великобритания', 'country_code' => 'GB', 'population' => 129000],

            // Италия
            ['name' => 'Рим', 'name_en' => 'rome', 'lat' => 41.9028, 'lng' => 12.4964, 'country' => 'Италия', 'country_code' => 'IT', 'population' => 2860009],
            ['name' => 'Милан', 'name_en' => 'milan', 'lat' => 45.4642, 'lng' => 9.1900, 'country' => 'Италия', 'country_code' => 'IT', 'population' => 1371498],
            ['name' => 'Неаполь', 'name_en' => 'naples', 'lat' => 40.8518, 'lng' => 14.2681, 'country' => 'Италия', 'country_code' => 'IT', 'population' => 963827],
            ['name' => 'Турин', 'name_en' => 'turin', 'lat' => 45.0703, 'lng' => 7.6869, 'country' => 'Италия', 'country_code' => 'IT', 'population' => 870456],
            ['name' => 'Палермо', 'name_en' => 'palermo', 'lat' => 38.1157, 'lng' => 13.3615, 'country' => 'Италия', 'country_code' => 'IT', 'population' => 663401],
            ['name' => 'Генуя', 'name_en' => 'genoa', 'lat' => 44.4056, 'lng' => 8.9463, 'country' => 'Италия', 'country_code' => 'IT', 'population' => 580223],
            ['name' => 'Болонья', 'name_en' => 'bologna', 'lat' => 44.4949, 'lng' => 11.3426, 'country' => 'Италия', 'country_code' => 'IT', 'population' => 390636],
            ['name' => 'Флоренция', 'name_en' => 'florence', 'lat' => 43.7696, 'lng' => 11.2558, 'country' => 'Италия', 'country_code' => 'IT', 'population' => 367150],
            ['name' => 'Баку... (вообще Баку азиатский, пропустим)', 'name_en' => '', 'lat' => 0, 'lng' => 0, 'country' => '', 'country_code' => '', 'population' => 0],
            ['name' => 'Бари', 'name_en' => 'bari', 'lat' => 41.1171, 'lng' => 16.8719, 'country' => 'Италия', 'country_code' => 'IT', 'population' => 316532],
            ['name' => 'Катания', 'name_en' => 'catania', 'lat' => 37.5023, 'lng' => 15.0873, 'country' => 'Италия', 'country_code' => 'IT', 'population' => 303670],
            ['name' => 'Венеция', 'name_en' => 'venice', 'lat' => 45.4408, 'lng' => 12.3155, 'country' => 'Италия', 'country_code' => 'IT', 'population' => 258685],
            ['name' => 'Верона', 'name_en' => 'verona', 'lat' => 45.4386, 'lng' => 10.9916, 'country' => 'Италия', 'country_code' => 'IT', 'population' => 258108],
            ['name' => 'Мессина', 'name_en' => 'messina', 'lat' => 38.1938, 'lng' => 15.5540, 'country' => 'Италия', 'country_code' => 'IT', 'population' => 229598],
            ['name' => 'Падуя', 'name_en' => 'padua', 'lat' => 45.4064, 'lng' => 11.8768, 'country' => 'Италия', 'country_code' => 'IT', 'population' => 214198],
            ['name' => 'Триест', 'name_en' => 'trieste', 'lat' => 45.6495, 'lng' => 13.7768, 'country' => 'Италия', 'country_code' => 'IT', 'population' => 207500],
            ['name' => 'Тренто', 'name_en' => 'trento', 'lat' => 46.0748, 'lng' => 11.1217, 'country' => 'Италия', 'country_code' => 'IT', 'population' => 118142],
            ['name' => 'Перуджа', 'name_en' => 'perugia', 'lat' => 43.1107, 'lng' => 12.3908, 'country' => 'Италия', 'country_code' => 'IT', 'population' => 165683],
            ['name' => 'Реджо-ди-Калабрия', 'name_en' => 'reggio calabria', 'lat' => 38.1113, 'lng' => 15.6474, 'country' => 'Италия', 'country_code' => 'IT', 'population' => 182500],

            // Испания
            ['name' => 'Мадрид', 'name_en' => 'madrid', 'lat' => 40.4168, 'lng' => -3.7038, 'country' => 'Испания', 'country_code' => 'ES', 'population' => 3305408],
            ['name' => 'Барселона', 'name_en' => 'barcelona', 'lat' => 41.3851, 'lng' => 2.1734, 'country' => 'Испания', 'country_code' => 'ES', 'population' => 1620343],
            ['name' => 'Валенсия', 'name_en' => 'valencia', 'lat' => 39.4699, 'lng' => -0.3763, 'country' => 'Испания', 'country_code' => 'ES', 'population' => 810064],
            ['name' => 'Севилья', 'name_en' => 'seville', 'lat' => 37.3891, 'lng' => -5.9845, 'country' => 'Испания', 'country_code' => 'ES', 'population' => 689434],
            ['name' => 'Сарагоса', 'name_en' => 'zaragoza', 'lat' => 41.6561, 'lng' => -0.8773, 'country' => 'Испания', 'country_code' => 'ES', 'population' => 674997],
            ['name' => 'Малага', 'name_en' => 'malaga', 'lat' => 36.7213, 'lng' => -4.4214, 'country' => 'Испания', 'country_code' => 'ES', 'population' => 578460],
            ['name' => 'Мурсия', 'name_en' => 'murcia', 'lat' => 37.9922, 'lng' => -1.1307, 'country' => 'Испания', 'country_code' => 'ES', 'population' => 453258],
            ['name' => 'Пальма', 'name_en' => 'palma', 'lat' => 39.5696, 'lng' => 2.6502, 'country' => 'Испания', 'country_code' => 'ES', 'population' => 416447],
            ['name' => 'Лас-Пальмас', 'name_en' => 'las palmas', 'lat' => 28.1235, 'lng' => -15.4363, 'country' => 'Испания', 'country_code' => 'ES', 'population' => 379925],
            ['name' => 'Бильбао', 'name_en' => 'bilbao', 'lat' => 43.2630, 'lng' => -2.9350, 'country' => 'Испания', 'country_code' => 'ES', 'population' => 345122],
            ['name' => 'Аликанте', 'name_en' => 'alicante', 'lat' => 38.3453, 'lng' => -0.4831, 'country' => 'Испания', 'country_code' => 'ES', 'population' => 330525],
            ['name' => 'Кордова', 'name_en' => 'cordoba', 'lat' => 37.8882, 'lng' => -4.7794, 'country' => 'Испания', 'country_code' => 'ES', 'population' => 325453],
            ['name' => 'Вальядолид', 'name_en' => 'valladolid', 'lat' => 41.6523, 'lng' => -4.7245, 'country' => 'Испания', 'country_code' => 'ES', 'population' => 305319],
            ['name' => 'Виго', 'name_en' => 'vigo', 'lat' => 42.2314, 'lng' => -8.7124, 'country' => 'Испания', 'country_code' => 'ES', 'population' => 292817],
            ['name' => 'Хихон', 'name_en' => 'gijon', 'lat' => 43.5322, 'lng' => -5.6611, 'country' => 'Испания', 'country_code' => 'ES', 'population' => 270186],
            ['name' => 'Гранада', 'name_en' => 'granada', 'lat' => 37.1773, 'lng' => -3.5986, 'country' => 'Испания', 'country_code' => 'ES', 'population' => 232462],
            ['name' => 'Оветьедо', 'name_en' => 'oviedo', 'lat' => 43.3614, 'lng' => -5.8593, 'country' => 'Испания', 'country_code' => 'ES', 'population' => 220231],
            ['name' => 'Сантьяго-де-Компостела', 'name_en' => 'santiago de compostela', 'lat' => 42.8782, 'lng' => -8.5448, 'country' => 'Испания', 'country_code' => 'ES', 'population' => 97849],
            ['name' => 'Памплона', 'name_en' => 'pamplona', 'lat' => 42.8125, 'lng' => -1.6458, 'country' => 'Испания', 'country_code' => 'ES', 'population' => 202714],
            ['name' => 'Логроньо', 'name_en' => 'logrono', 'lat' => 42.4650, 'lng' => -2.4456, 'country' => 'Испания', 'country_code' => 'ES', 'population' => 152306],
            ['name' => 'Бургос', 'name_en' => 'burgos', 'lat' => 42.3440, 'lng' => -3.6970, 'country' => 'Испания', 'country_code' => 'ES', 'population' => 174116],

            // Польша
            ['name' => 'Варшава', 'name_en' => 'warsaw', 'lat' => 52.2297, 'lng' => 21.0122, 'country' => 'Польша', 'country_code' => 'PL', 'population' => 1793579],
            ['name' => 'Краков', 'name_en' => 'krakow', 'lat' => 50.0647, 'lng' => 19.9450, 'country' => 'Польша', 'country_code' => 'PL', 'population' => 779966],
            ['name' => 'Лодзь', 'name_en' => 'lodz', 'lat' => 51.7592, 'lng' => 19.4560, 'country' => 'Польша', 'country_code' => 'PL', 'population' => 679941],
            ['name' => 'Вроцлав', 'name_en' => 'wroclaw', 'lat' => 51.1079, 'lng' => 17.0385, 'country' => 'Польша', 'country_code' => 'PL', 'population' => 641607],
            ['name' => 'Познань', 'name_en' => 'poznan', 'lat' => 52.4064, 'lng' => 16.9252, 'country' => 'Польша', 'country_code' => 'PL', 'population' => 536438],
            ['name' => 'Гданьск', 'name_en' => 'gdansk', 'lat' => 54.3520, 'lng' => 18.6466, 'country' => 'Польша', 'country_code' => 'PL', 'population' => 470907],
            ['name' => 'Щецин', 'name_en' => 'szczecin', 'lat' => 53.4285, 'lng' => 14.5528, 'country' => 'Польша', 'country_code' => 'PL', 'population' => 399616],
            ['name' => 'Быдгощ', 'name_en' => 'bydgoszcz', 'lat' => 53.1235, 'lng' => 18.0084, 'country' => 'Польша', 'country_code' => 'PL', 'population' => 344967],
            ['name' => 'Люблин', 'name_en' => 'lublin', 'lat' => 51.2465, 'lng' => 22.5684, 'country' => 'Польша', 'country_code' => 'PL', 'population' => 339547],
            ['name' => 'Катовице', 'name_en' => 'katowice', 'lat' => 50.2649, 'lng' => 19.0238, 'country' => 'Польша', 'country_code' => 'PL', 'population' => 291000],
            ['name' => 'Белосток', 'name_en' => 'bialystok', 'lat' => 53.1325, 'lng' => 23.1688, 'country' => 'Польша', 'country_code' => 'PL', 'population' => 296820],
            ['name' => 'Гдыня', 'name_en' => 'gdynia', 'lat' => 54.5189, 'lng' => 18.5305, 'country' => 'Польша', 'country_code' => 'PL', 'population' => 246876],

            // Украина
            ['name' => 'Киев', 'name_en' => 'kyiv', 'lat' => 50.4501, 'lng' => 30.5234, 'country' => 'Украина', 'country_code' => 'UA', 'population' => 2967360],
            ['name' => 'Харьков', 'name_en' => 'kharkiv', 'lat' => 49.9935, 'lng' => 36.2304, 'country' => 'Украина', 'country_code' => 'UA', 'population' => 1433886],
            ['name' => 'Одесса', 'name_en' => 'odessa', 'lat' => 46.4825, 'lng' => 30.7233, 'country' => 'Украина', 'country_code' => 'UA', 'population' => 993120],
            ['name' => 'Днепр', 'name_en' => 'dnipro', 'lat' => 48.4647, 'lng' => 35.0462, 'country' => 'Украина', 'country_code' => 'UA', 'population' => 990724],
            ['name' => 'Донецк', 'name_en' => 'donetsk', 'lat' => 48.0159, 'lng' => 37.8028, 'country' => 'Украина', 'country_code' => 'UA', 'population' => 905364],
            ['name' => 'Запорожье', 'name_en' => 'zaporizhzhia', 'lat' => 47.8388, 'lng' => 35.1396, 'country' => 'Украина', 'country_code' => 'UA', 'population' => 710052],
            ['name' => 'Львов', 'name_en' => 'lviv', 'lat' => 49.8397, 'lng' => 24.0297, 'country' => 'Украина', 'country_code' => 'UA', 'population' => 717803],
            ['name' => 'Кривой Рог', 'name_en' => 'kryvyi rih', 'lat' => 47.9077, 'lng' => 33.3960, 'country' => 'Украина', 'country_code' => 'UA', 'population' => 612750],
            ['name' => 'Николаев', 'name_en' => 'mykolaiv', 'lat' => 46.9750, 'lng' => 32.0000, 'country' => 'Украина', 'country_code' => 'UA', 'population' => 476101],
            ['name' => 'Херсон', 'name_en' => 'kherson', 'lat' => 46.6354, 'lng' => 32.6169, 'country' => 'Украина', 'country_code' => 'UA', 'population' => 280821],
            ['name' => 'Луцк', 'name_en' => 'lutsk', 'lat' => 50.7472, 'lng' => 25.3254, 'country' => 'Украина', 'country_code' => 'UA', 'population' => 220395],
            ['name' => 'Ужгород', 'name_en' => 'uzhhorod', 'lat' => 48.6208, 'lng' => 22.2879, 'country' => 'Украина', 'country_code' => 'UA', 'population' => 115446],
            ['name' => 'Черновцы', 'name_en' => 'chernivtsi', 'lat' => 48.2921, 'lng' => 25.9358, 'country' => 'Украина', 'country_code' => 'UA', 'population' => 263855],
            ['name' => 'Ивано-Франковск', 'name_en' => 'ivano-frankivsk', 'lat' => 48.9226, 'lng' => 24.7111, 'country' => 'Украина', 'country_code' => 'UA', 'population' => 237855],
            ['name' => 'Тернополь', 'name_en' => 'ternopil', 'lat' => 49.5535, 'lng' => 25.5948, 'country' => 'Украина', 'country_code' => 'UA', 'population' => 225696],
            ['name' => 'Хмельницкий', 'name_en' => 'khmelnytskyi', 'lat' => 49.4230, 'lng' => 26.9870, 'country' => 'Украина', 'country_code' => 'UA', 'population' => 261952],
            ['name' => 'Черкассы', 'name_en' => 'cherkasy', 'lat' => 49.4444, 'lng' => 32.0598, 'country' => 'Украина', 'country_code' => 'UA', 'population' => 272000],
            ['name' => 'Полтава', 'name_en' => 'poltava', 'lat' => 49.5883, 'lng' => 34.5514, 'country' => 'Украина', 'country_code' => 'UA', 'population' => 293317],
            ['name' => 'Чернигов', 'name_en' => 'chernihiv', 'lat' => 51.4982, 'lng' => 31.2893, 'country' => 'Украина', 'country_code' => 'UA', 'population' => 285234],
            ['name' => 'Сумы', 'name_en' => 'sumy', 'lat' => 50.9077, 'lng' => 34.8003, 'country' => 'Украина', 'country_code' => 'UA', 'population' => 260318],
            ['name' => 'Житомир', 'name_en' => 'zhytomyr', 'lat' => 50.2547, 'lng' => 28.6587, 'country' => 'Украина', 'country_code' => 'UA', 'population' => 263989],
            ['name' => 'Винница', 'name_en' => 'vinnytsia', 'lat' => 49.2331, 'lng' => 28.4682, 'country' => 'Украина', 'country_code' => 'UA', 'population' => 370641],
            ['name' => 'Ровно', 'name_en' => 'rivne', 'lat' => 50.6199, 'lng' => 26.2516, 'country' => 'Украина', 'country_code' => 'UA', 'population' => 247451],

            // Нидерланды
            ['name' => 'Амстердам', 'name_en' => 'amsterdam', 'lat' => 52.3676, 'lng' => 4.9041, 'country' => 'Нидерланды', 'country_code' => 'NL', 'population' => 872757],
            ['name' => 'Роттердам', 'name_en' => 'rotterdam', 'lat' => 51.9225, 'lng' => 4.4792, 'country' => 'Нидерланды', 'country_code' => 'NL', 'population' => 651157],
            ['name' => 'Гаага', 'name_en' => 'the hague', 'lat' => 52.0705, 'lng' => 4.3007, 'country' => 'Нидерланды', 'country_code' => 'NL', 'population' => 545163],
            ['name' => 'Утрехт', 'name_en' => 'utrecht', 'lat' => 52.0907, 'lng' => 5.1214, 'country' => 'Нидерланды', 'country_code' => 'NL', 'population' => 357179],
            ['name' => 'Эйндховен', 'name_en' => 'eindhoven', 'lat' => 51.4416, 'lng' => 5.4697, 'country' => 'Нидерланды', 'country_code' => 'NL', 'population' => 232000],

            // Бельгия
            ['name' => 'Брюссель', 'name_en' => 'brussels', 'lat' => 50.8503, 'lng' => 4.3517, 'country' => 'Бельгия', 'country_code' => 'BE', 'population' => 1218255],
            ['name' => 'Антверпен', 'name_en' => 'antwerp', 'lat' => 51.2194, 'lng' => 4.4025, 'country' => 'Бельгия', 'country_code' => 'BE', 'population' => 529247],
            ['name' => 'Гент', 'name_en' => 'ghent', 'lat' => 51.0543, 'lng' => 3.7174, 'country' => 'Бельгия', 'country_code' => 'BE', 'population' => 263927],
            ['name' => 'Брюгге', 'name_en' => 'bruges', 'lat' => 51.2093, 'lng' => 3.2247, 'country' => 'Бельгия', 'country_code' => 'BE', 'population' => 118325],
            ['name' => 'Льеж', 'name_en' => 'liege', 'lat' => 50.6451, 'lng' => 5.5724, 'country' => 'Бельгия', 'country_code' => 'BE', 'population' => 196825],
            ['name' => 'Шарлеруа', 'name_en' => 'charleroi', 'lat' => 50.4108, 'lng' => 4.4446, 'country' => 'Бельгия', 'country_code' => 'BE', 'population' => 202598],

            // Швейцария
            ['name' => 'Цюрих', 'name_en' => 'zurich', 'lat' => 47.3769, 'lng' => 8.5417, 'country' => 'Швейцария', 'country_code' => 'CH', 'population' => 434335],
            ['name' => 'Женева', 'name_en' => 'geneva', 'lat' => 46.2044, 'lng' => 6.1432, 'country' => 'Швейцария', 'country_code' => 'CH', 'population' => 201818],
            ['name' => 'Базель', 'name_en' => 'basel', 'lat' => 47.5596, 'lng' => 7.5886, 'country' => 'Швейцария', 'country_code' => 'CH', 'population' => 178120],
            ['name' => 'Берн', 'name_en' => 'bern', 'lat' => 46.9480, 'lng' => 7.4474, 'country' => 'Швейцария', 'country_code' => 'CH', 'population' => 134794],
            ['name' => 'Лозанна', 'name_en' => 'lausanne', 'lat' => 46.5197, 'lng' => 6.6323, 'country' => 'Швейцария', 'country_code' => 'CH', 'population' => 140000],
            ['name' => 'Люцерн', 'name_en' => 'lucerne', 'lat' => 47.0502, 'lng' => 8.3093, 'country' => 'Швейцария', 'country_code' => 'CH', 'population' => 82000],

            // Австрия
            ['name' => 'Вена', 'name_en' => 'vienna', 'lat' => 48.2082, 'lng' => 16.3738, 'country' => 'Австрия', 'country_code' => 'AT', 'population' => 1897491],
            ['name' => 'Грац', 'name_en' => 'graz', 'lat' => 47.0707, 'lng' => 15.4395, 'country' => 'Австрия', 'country_code' => 'AT', 'population' => 291072],
            ['name' => 'Линц', 'name_en' => 'linz', 'lat' => 48.3069, 'lng' => 14.2858, 'country' => 'Австрия', 'country_code' => 'AT', 'population' => 204846],
            ['name' => 'Зальцбург', 'name_en' => 'salzburg', 'lat' => 47.8095, 'lng' => 13.0550, 'country' => 'Австрия', 'country_code' => 'AT', 'population' => 155021],
            ['name' => 'Инсбрук', 'name_en' => 'innsbruck', 'lat' => 47.2692, 'lng' => 11.4041, 'country' => 'Австрия', 'country_code' => 'AT', 'population' => 131961],

            // Швеция
            ['name' => 'Стокгольм', 'name_en' => 'stockholm', 'lat' => 59.3293, 'lng' => 18.0686, 'country' => 'Швеция', 'country_code' => 'SE', 'population' => 979851],
            ['name' => 'Гётеборг', 'name_en' => 'gothenburg', 'lat' => 57.7089, 'lng' => 11.9746, 'country' => 'Швеция', 'country_code' => 'SE', 'population' => 582381],
            ['name' => 'Мальмё', 'name_en' => 'malmo', 'lat' => 55.6050, 'lng' => 13.0038, 'country' => 'Швеция', 'country_code' => 'SE', 'population' => 347949],
            ['name' => 'Уппсала', 'name_en' => 'uppsala', 'lat' => 59.8586, 'lng' => 17.6389, 'country' => 'Швеция', 'country_code' => 'SE', 'population' => 230767],
            ['name' => 'Вестерос', 'name_en' => 'vasteras', 'lat' => 59.6099, 'lng' => 16.5448, 'country' => 'Швеция', 'country_code' => 'SE', 'population' => 154049],
            ['name' => 'Эребру', 'name_en' => 'orebro', 'lat' => 59.2741, 'lng' => 15.2066, 'country' => 'Швеция', 'country_code' => 'SE', 'population' => 154029],
            ['name' => 'Линчёпинг', 'name_en' => 'linkoping', 'lat' => 58.4108, 'lng' => 15.6214, 'country' => 'Швеция', 'country_code' => 'SE', 'population' => 164616],

            // Норвегия
            ['name' => 'Осло', 'name_en' => 'oslo', 'lat' => 59.9139, 'lng' => 10.7522, 'country' => 'Норвегия', 'country_code' => 'NO', 'population' => 693491],
            ['name' => 'Берген', 'name_en' => 'bergen', 'lat' => 60.3913, 'lng' => 5.3221, 'country' => 'Норвегия', 'country_code' => 'NO', 'population' => 283929],
            ['name' => 'Тронхейм', 'name_en' => 'trondheim', 'lat' => 63.4305, 'lng' => 10.3951, 'country' => 'Норвегия', 'country_code' => 'NO', 'population' => 205849],
            ['name' => 'Ставангер', 'name_en' => 'stavanger', 'lat' => 58.9700, 'lng' => 5.7331, 'country' => 'Норвегия', 'country_code' => 'NO', 'population' => 144163],

            // Дания
            ['name' => 'Копенгаген', 'name_en' => 'copenhagen', 'lat' => 55.6761, 'lng' => 12.5683, 'country' => 'Дания', 'country_code' => 'DK', 'population' => 794128],
            ['name' => 'Орхус', 'name_en' => 'aarhus', 'lat' => 56.1629, 'lng' => 10.2039, 'country' => 'Дания', 'country_code' => 'DK', 'population' => 285273],
            ['name' => 'Оденсе', 'name_en' => 'odense', 'lat' => 55.4038, 'lng' => 10.4024, 'country' => 'Дания', 'country_code' => 'DK', 'population' => 180863],
            ['name' => 'Ольборг', 'name_en' => 'aalborg', 'lat' => 57.0488, 'lng' => 9.9217, 'country' => 'Дания', 'country_code' => 'DK', 'population' => 116314],

            // Финляндия
            ['name' => 'Хельсинки', 'name_en' => 'helsinki', 'lat' => 60.1699, 'lng' => 24.9384, 'country' => 'Финляндия', 'country_code' => 'FI', 'population' => 656229],
            ['name' => 'Тампере', 'name_en' => 'tampere', 'lat' => 61.4978, 'lng' => 23.7610, 'country' => 'Финляндия', 'country_code' => 'FI', 'population' => 241574],
            ['name' => 'Турку', 'name_en' => 'turku', 'lat' => 60.4518, 'lng' => 22.2666, 'country' => 'Финляндия', 'country_code' => 'FI', 'population' => 193210],
            ['name' => 'Оулу', 'name_en' => 'oulu', 'lat' => 65.0121, 'lng' => 25.4651, 'country' => 'Финляндия', 'country_code' => 'FI', 'population' => 208097],

            // Румыния
            ['name' => 'Бухарест', 'name_en' => 'bucharest', 'lat' => 44.4268, 'lng' => 26.1025, 'country' => 'Румыния', 'country_code' => 'RO', 'population' => 1883425],
            ['name' => 'Клуж-Напока', 'name_en' => 'cluj-napoca', 'lat' => 46.7712, 'lng' => 23.6236, 'country' => 'Румыния', 'country_code' => 'RO', 'population' => 324576],
            ['name' => 'Тимишоара', 'name_en' => 'timisoara', 'lat' => 45.7489, 'lng' => 21.2087, 'country' => 'Румыния', 'country_code' => 'RO', 'population' => 319279],
            ['name' => 'Яссы', 'name_en' => 'iasi', 'lat' => 47.1585, 'lng' => 27.6014, 'country' => 'Румыния', 'country_code' => 'RO', 'population' => 290422],
            ['name' => 'Констанца', 'name_en' => 'constanta', 'lat' => 44.1598, 'lng' => 28.6348, 'country' => 'Румыния', 'country_code' => 'RO', 'population' => 283872],
            ['name' => 'Галац', 'name_en' => 'galati', 'lat' => 45.4353, 'lng' => 28.0519, 'country' => 'Румыния', 'country_code' => 'RO', 'population' => 249432],
            ['name' => 'Брашов', 'name_en' => 'brasov', 'lat' => 45.6427, 'lng' => 25.5887, 'country' => 'Румыния', 'country_code' => 'RO', 'population' => 253200],
            ['name' => 'Плоешти', 'name_en' => 'ploiesti', 'lat' => 44.9407, 'lng' => 26.0365, 'country' => 'Румыния', 'country_code' => 'RO', 'population' => 209945],

            // Венгрия
            ['name' => 'Будапешт', 'name_en' => 'budapest', 'lat' => 47.4979, 'lng' => 19.0402, 'country' => 'Венгрия', 'country_code' => 'HU', 'population' => 1752704],
            ['name' => 'Дебрецен', 'name_en' => 'debrecen', 'lat' => 47.5316, 'lng' => 21.6273, 'country' => 'Венгрия', 'country_code' => 'HU', 'population' => 201432],
            ['name' => 'Мишкольц', 'name_en' => 'miskolc', 'lat' => 48.1035, 'lng' => 20.7784, 'country' => 'Венгрия', 'country_code' => 'HU', 'population' => 155740],
            ['name' => 'Печ', 'name_en' => 'pecs', 'lat' => 46.0727, 'lng' => 18.2330, 'country' => 'Венгрия', 'country_code' => 'HU', 'population' => 145347],
            ['name' => 'Дьёр', 'name_en' => 'gyor', 'lat' => 47.6875, 'lng' => 17.6504, 'country' => 'Венгрия', 'country_code' => 'HU', 'population' => 128567],

            // Чехия
            ['name' => 'Прага', 'name_en' => 'prague', 'lat' => 50.0755, 'lng' => 14.4378, 'country' => 'Чехия', 'country_code' => 'CZ', 'population' => 1335084],
            ['name' => 'Брно', 'name_en' => 'brno', 'lat' => 49.1951, 'lng' => 16.6068, 'country' => 'Чехия', 'country_code' => 'CZ', 'population' => 379527],
            ['name' => 'Острава', 'name_en' => 'ostrava', 'lat' => 49.8209, 'lng' => 18.2625, 'country' => 'Чехия', 'country_code' => 'CZ', 'population' => 287968],
            ['name' => 'Пльзень', 'name_en' => 'plzen', 'lat' => 49.7384, 'lng' => 13.3736, 'country' => 'Чехия', 'country_code' => 'CZ', 'population' => 173150],
            ['name' => 'Либерец', 'name_en' => 'liberec', 'lat' => 50.7671, 'lng' => 15.0562, 'country' => 'Чехия', 'country_code' => 'CZ', 'population' => 103979],

            // Словакия
            ['name' => 'Братислава', 'name_en' => 'bratislava', 'lat' => 48.1486, 'lng' => 17.1077, 'country' => 'Словакия', 'country_code' => 'SK', 'population' => 476206],
            ['name' => 'Кошице', 'name_en' => 'kosice', 'lat' => 48.7164, 'lng' => 21.2611, 'country' => 'Словакия', 'country_code' => 'SK', 'population' => 228249],

            // Беларусь
            ['name' => 'Минск', 'name_en' => 'minsk', 'lat' => 53.9045, 'lng' => 27.5615, 'country' => 'Беларусь', 'country_code' => 'BY', 'population' => 2009786],
            ['name' => 'Гомель', 'name_en' => 'gomel', 'lat' => 52.4345, 'lng' => 30.9754, 'country' => 'Беларусь', 'country_code' => 'BY', 'population' => 484308],
            ['name' => 'Могилёв', 'name_en' => 'mogilev', 'lat' => 53.9000, 'lng' => 30.3333, 'country' => 'Беларусь', 'country_code' => 'BY', 'population' => 383413],
            ['name' => 'Витебск', 'name_en' => 'vitebsk', 'lat' => 55.1856, 'lng' => 30.2049, 'country' => 'Беларусь', 'country_code' => 'BY', 'population' => 363497],
            ['name' => 'Гродно', 'name_en' => 'grodno', 'lat' => 53.6884, 'lng' => 23.8258, 'country' => 'Беларусь', 'country_code' => 'BY', 'population' => 373547],
            ['name' => 'Брест', 'name_en' => 'brest', 'lat' => 52.0976, 'lng' => 23.6877, 'country' => 'Беларусь', 'country_code' => 'BY', 'population' => 349101],

            // Португалия
            ['name' => 'Лиссабон', 'name_en' => 'lisbon', 'lat' => 38.7223, 'lng' => -9.1393, 'country' => 'Португалия', 'country_code' => 'PT', 'population' => 544851],
            ['name' => 'Порту', 'name_en' => 'porto', 'lat' => 41.1579, 'lng' => -8.6291, 'country' => 'Португалия', 'country_code' => 'PT', 'population' => 237559],
            ['name' => 'Амадора', 'name_en' => 'amadora', 'lat' => 38.7527, 'lng' => -9.2304, 'country' => 'Португалия', 'country_code' => 'PT', 'population' => 175136],
            ['name' => 'Брага', 'name_en' => 'braga', 'lat' => 41.5503, 'lng' => -8.4200, 'country' => 'Португалия', 'country_code' => 'PT', 'population' => 193333],
            ['name' => 'Коимбра', 'name_en' => 'coimbra', 'lat' => 40.2033, 'lng' => -8.4103, 'country' => 'Португалия', 'country_code' => 'PT', 'population' => 143396],

            // Греция
            ['name' => 'Афины', 'name_en' => 'athens', 'lat' => 37.9838, 'lng' => 23.7275, 'country' => 'Греция', 'country_code' => 'GR', 'population' => 664046],
            ['name' => 'Салоники', 'name_en' => 'thessaloniki', 'lat' => 40.6401, 'lng' => 22.9444, 'country' => 'Греция', 'country_code' => 'GR', 'population' => 354290],
            ['name' => 'Патры', 'name_en' => 'patras', 'lat' => 38.2466, 'lng' => 21.7346, 'country' => 'Греция', 'country_code' => 'GR', 'population' => 168034],
            ['name' => 'Ираклион', 'name_en' => 'heraklion', 'lat' => 35.3387, 'lng' => 25.1442, 'country' => 'Греция', 'country_code' => 'GR', 'population' => 140730],
            ['name' => 'Лариса', 'name_en' => 'larissa', 'lat' => 39.6390, 'lng' => 22.4191, 'country' => 'Греция', 'country_code' => 'GR', 'population' => 144651],

            // Болгария
            ['name' => 'София', 'name_en' => 'sofia', 'lat' => 42.6977, 'lng' => 23.3219, 'country' => 'Болгария', 'country_code' => 'BG', 'population' => 1307439],
            ['name' => 'Пловдив', 'name_en' => 'plovdiv', 'lat' => 42.1354, 'lng' => 24.7453, 'country' => 'Болгария', 'country_code' => 'BG', 'population' => 346893],
            ['name' => 'Варна', 'name_en' => 'varna', 'lat' => 43.2141, 'lng' => 27.9147, 'country' => 'Болгария', 'country_code' => 'BG', 'population' => 334870],
            ['name' => 'Бургас', 'name_en' => 'burgas', 'lat' => 42.5048, 'lng' => 27.4626, 'country' => 'Болгария', 'country_code' => 'BG', 'population' => 202766],
            ['name' => 'Русе', 'name_en' => 'ruse', 'lat' => 43.8356, 'lng' => 25.9657, 'country' => 'Болгария', 'country_code' => 'BG', 'population' => 138447],
            ['name' => 'Стара-Загора', 'name_en' => 'stara zagora', 'lat' => 42.4257, 'lng' => 25.6345, 'country' => 'Болгария', 'country_code' => 'BG', 'population' => 138272],

            // Сербия
            ['name' => 'Белград', 'name_en' => 'belgrade', 'lat' => 44.8176, 'lng' => 20.4569, 'country' => 'Сербия', 'country_code' => 'RS', 'population' => 1688667],
            ['name' => 'Нови-Сад', 'name_en' => 'novi sad', 'lat' => 45.2671, 'lng' => 19.8335, 'country' => 'Сербия', 'country_code' => 'RS', 'population' => 289128],
            ['name' => 'Ниш', 'name_en' => 'nis', 'lat' => 43.3209, 'lng' => 21.8958, 'country' => 'Сербия', 'country_code' => 'RS', 'population' => 257867],
            ['name' => 'Крагуевац', 'name_en' => 'kragujevac', 'lat' => 44.0128, 'lng' => 20.9114, 'country' => 'Сербия', 'country_code' => 'RS', 'population' => 150000],

            // Хорватия
            ['name' => 'Загреб', 'name_en' => 'zagreb', 'lat' => 45.8150, 'lng' => 15.9819, 'country' => 'Хорватия', 'country_code' => 'HR', 'population' => 806341],
            ['name' => 'Сплит', 'name_en' => 'split', 'lat' => 43.5081, 'lng' => 16.4402, 'country' => 'Хорватия', 'country_code' => 'HR', 'population' => 178102],
            ['name' => 'Риека', 'name_en' => 'rijeka', 'lat' => 45.3271, 'lng' => 14.4422, 'country' => 'Хорватия', 'country_code' => 'HR', 'population' => 128624],
            ['name' => 'Дубровник', 'name_en' => 'dubrovnik', 'lat' => 42.6507, 'lng' => 18.0944, 'country' => 'Хорватия', 'country_code' => 'HR', 'population' => 42641],

            // Словения
            ['name' => 'Любляна', 'name_en' => 'ljubljana', 'lat' => 46.0569, 'lng' => 14.5058, 'country' => 'Словения', 'country_code' => 'SI', 'population' => 284355],
            ['name' => 'Марибор', 'name_en' => 'maribor', 'lat' => 46.5547, 'lng' => 15.6467, 'country' => 'Словения', 'country_code' => 'SI', 'population' => 95171],

            // Эстония
            ['name' => 'Таллин', 'name_en' => 'tallinn', 'lat' => 59.4370, 'lng' => 24.7536, 'country' => 'Эстония', 'country_code' => 'EE', 'population' => 437619],
            ['name' => 'Тарту', 'name_en' => 'tartu', 'lat' => 58.3776, 'lng' => 26.7290, 'country' => 'Эстония', 'country_code' => 'EE', 'population' => 91407],
            ['name' => 'Нарва', 'name_en' => 'narva', 'lat' => 59.3772, 'lng' => 28.1780, 'country' => 'Эстония', 'country_code' => 'EE', 'population' => 54442],

            // Латвия
            ['name' => 'Рига', 'name_en' => 'riga', 'lat' => 56.9460, 'lng' => 24.1059, 'country' => 'Латвия', 'country_code' => 'LV', 'population' => 632614],
            ['name' => 'Даугавпилс', 'name_en' => 'daugavpils', 'lat' => 55.8747, 'lng' => 26.5361, 'country' => 'Латвия', 'country_code' => 'LV', 'population' => 82396],
            ['name' => 'Лиепая', 'name_en' => 'liepaja', 'lat' => 56.5052, 'lng' => 21.0113, 'country' => 'Латвия', 'country_code' => 'LV', 'population' => 68945],

            // Литва
            ['name' => 'Вильнюс', 'name_en' => 'vilnius', 'lat' => 54.6872, 'lng' => 25.2797, 'country' => 'Литва', 'country_code' => 'LT', 'population' => 580020],
            ['name' => 'Каунас', 'name_en' => 'kaunas', 'lat' => 54.8985, 'lng' => 23.9036, 'country' => 'Литва', 'country_code' => 'LT', 'population' => 289394],
            ['name' => 'Клайпеда', 'name_en' => 'klaipeda', 'lat' => 55.7033, 'lng' => 21.1443, 'country' => 'Литва', 'country_code' => 'LT', 'population' => 149269],

            // Молдова
            ['name' => 'Кишинёв', 'name_en' => 'chisinau', 'lat' => 47.0105, 'lng' => 28.8638, 'country' => 'Молдова', 'country_code' => 'MD', 'population' => 700228],
            ['name' => 'Тирасполь', 'name_en' => 'tiraspol', 'lat' => 46.8403, 'lng' => 29.6433, 'country' => 'Молдова', 'country_code' => 'MD', 'population' => 159163],

            // Австрия уже была
            // Швейцария уже была

            // Ирландия
            ['name' => 'Дублин', 'name_en' => 'dublin', 'lat' => 53.3498, 'lng' => -6.2603, 'country' => 'Ирландия', 'country_code' => 'IE', 'population' => 1204000],
            ['name' => 'Корк', 'name_en' => 'cork', 'lat' => 51.8985, 'lng' => -8.4756, 'country' => 'Ирландия', 'country_code' => 'IE', 'population' => 208000],
            ['name' => 'Голуэй', 'name_en' => 'galway', 'lat' => 53.2743, 'lng' => -9.0514, 'country' => 'Ирландия', 'country_code' => 'IE', 'population' => 80000],

            // Исландия
            ['name' => 'Рейкьявик', 'name_en' => 'reykjavik', 'lat' => 64.1355, 'lng' => -21.8954, 'country' => 'Исландия', 'country_code' => 'IS', 'population' => 131136],

            // Люксембург
            ['name' => 'Люксембург', 'name_en' => 'luxembourg', 'lat' => 49.6116, 'lng' => 6.1319, 'country' => 'Люксембург', 'country_code' => 'LU', 'population' => 125000],

            // Мальта
            ['name' => 'Валлетта', 'name_en' => 'valletta', 'lat' => 35.8989, 'lng' => 14.5146, 'country' => 'Мальта', 'country_code' => 'MT', 'population' => 6444],

            // Кипр
            ['name' => 'Никосия', 'name_en' => 'nicosia', 'lat' => 35.1856, 'lng' => 33.3823, 'country' => 'Кипр', 'country_code' => 'CY', 'population' => 331476],
            ['name' => 'Лимасол', 'name_en' => 'limassol', 'lat' => 34.6786, 'lng' => 33.0413, 'country' => 'Кипр', 'country_code' => 'CY', 'population' => 188000],

            // Северная Македония
            ['name' => 'Скопье', 'name_en' => 'skopje', 'lat' => 41.9973, 'lng' => 21.4280, 'country' => 'Северная Македония', 'country_code' => 'MK', 'population' => 525000],

            // Албания
            ['name' => 'Тирана', 'name_en' => 'tirana', 'lat' => 41.3317, 'lng' => 19.8319, 'country' => 'Албания', 'country_code' => 'AL', 'population' => 475000],
            ['name' => 'Дуррес', 'name_en' => 'durres', 'lat' => 41.3246, 'lng' => 19.4565, 'country' => 'Албания', 'country_code' => 'AL', 'population' => 113249],

            // Косово
            ['name' => 'Приштина', 'name_en' => 'pristina', 'lat' => 42.6629, 'lng' => 21.1655, 'country' => 'Косово', 'country_code' => 'XK', 'population' => 200000],

            // Черногория
            ['name' => 'Подгорица', 'name_en' => 'podgorica', 'lat' => 42.4411, 'lng' => 19.2636, 'country' => 'Черногория', 'country_code' => 'ME', 'population' => 190488],

            // Босния и Герцеговина
            ['name' => 'Сараево', 'name_en' => 'sarajevo', 'lat' => 43.8563, 'lng' => 18.4131, 'country' => 'Босния и Герцеговина', 'country_code' => 'BA', 'population' => 302811],
            ['name' => 'Баня-Лука', 'name_en' => 'banja luka', 'lat' => 44.7722, 'lng' => 17.1910, 'country' => 'Босния и Герцеговина', 'country_code' => 'BA', 'population' => 180053],

            // Андорра
            ['name' => 'Андорра-ла-Велья', 'name_en' => 'andorra la vella', 'lat' => 42.5063, 'lng' => 1.5218, 'country' => 'Андорра', 'country_code' => 'AD', 'population' => 22256],

            // Монако
            ['name' => 'Монако', 'name_en' => 'monaco', 'lat' => 43.7333, 'lng' => 7.4167, 'country' => 'Монако', 'country_code' => 'MC', 'population' => 38300],

            // Сан-Марино
            ['name' => 'Сан-Марино', 'name_en' => 'san marino', 'lat' => 43.9424, 'lng' => 12.4578, 'country' => 'Сан-Марино', 'country_code' => 'SM', 'population' => 4040],

            // Лихтенштейн
            ['name' => 'Вадуц', 'name_en' => 'vaduz', 'lat' => 47.1410, 'lng' => 9.5209, 'country' => 'Лихтенштейн', 'country_code' => 'LI', 'population' => 5765],

            // Азербайджан (европейская часть - Баку не совсем Европа, но часто включают)
            // Казахстан (только Атырау и Западный Казахстан в Европе)
            // Пропустим

            // Грузия - технически не в Европе по большинству определений, пропускаем
            // Армения - аналогично

            // Турция (европейская часть)
            ['name' => 'Стамбул', 'name_en' => 'istanbul', 'lat' => 41.0082, 'lng' => 28.9784, 'country' => 'Турция', 'country_code' => 'TR', 'population' => 15462452],
            ['name' => 'Эдирне', 'name_en' => 'edirne', 'lat' => 41.6818, 'lng' => 26.5623, 'country' => 'Турция', 'country_code' => 'TR', 'population' => 165970],

            // Норвегия доп.
            ['name' => 'Тромсё', 'name_en' => 'tromso', 'lat' => 69.6496, 'lng' => 18.9560, 'country' => 'Норвегия', 'country_code' => 'NO', 'population' => 77030],

            // Швеция доп.
            ['name' => 'Умео', 'name_en' => 'umea', 'lat' => 63.8258, 'lng' => 20.2630, 'country' => 'Швеция', 'country_code' => 'SE', 'population' => 130224],
            ['name' => 'Лулео', 'name_en' => 'lulea', 'lat' => 65.5848, 'lng' => 22.1547, 'country' => 'Швеция', 'country_code' => 'SE', 'population' => 78045],
        ];

        // Filter out placeholder entries
        $cities = array_filter($cities, fn($c) => $c['lat'] != 0 && $c['name_en'] != '');

        // Deduplicate by name_en
        $unique = [];
        foreach ($cities as $city) {
            $key = mb_strtolower($city['name']);
            if (!isset($unique[$key])) {
                $unique[$key] = $city;
            }
        }

        $chunks = array_chunk(array_values($unique), 100);
        foreach ($chunks as $chunk) {
            DB::table('cities')->insert($chunk);
        }
    }
}
