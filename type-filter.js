/**
 * type-filter.js
 * ──────────────────────────────────────────────────────────────────────────────
 * Подключение: <script src="type-filter.js"></script>
 * Или вставить содержимое целиком в консоль браузера (работает как сниппет).
 *
 * Логика:
 *   При изменении select[name="type_val"] показываем только те поля (и их
 *   родительские <p>), в атрибуте name которых встречается выбранное значение.
 *   Например, при выборе "2" видны: input_2, button_28, button_12 (содержит "2").
 *
 * Алгоритм — plain JS, querySelectorAll + indexOf:
 *   – O(n) по числу полей на каждое изменение — оптимально для небольших форм.
 *   – Нет зависимостей, работает с любым набором полей без изменения HTML.
 *
 * Рассмотренные альтернативы:
 *   – jQuery .filter()       — добавляет зависимость ради одной строки.
 *   – Map<value, fields[]>   — O(1) поиск, но избыточно для небольшой формы
 *                              и усложняет поддержку динамического DOM.
 *   – CSS-классы + classList — потребовал бы изменений в HTML.
 * ──────────────────────────────────────────────────────────────────────────────
 */

(function () {
    "use strict";

    /**
     * @param {string} selectedValue - текущее значение select (например, "2")
     */
    function applyFilter(selectedValue) {
        const fields = document.querySelectorAll('[name]:not([name="type_val"])');

        fields.forEach(function (field) {
            const name = field.getAttribute("name") || "";
            const parentParagraph = field.closest("p");

            if (!parentParagraph) return;

            const visible = selectedValue === "" || name.indexOf(selectedValue) !== -1;
            parentParagraph.style.display = visible ? "" : "none";
        });
    }

    function init() {
        const typeSelect = document.querySelector('select[name="type_val"]');

        if (!typeSelect) {
            console.warn("[type-filter] select[name=\"type_val\"] не найден на странице.");
            return;
        }

        // Применить фильтр при изменении выбора
        typeSelect.addEventListener("change", function () {
            applyFilter(this.value);
        });

        // Применить немедленно для текущего значения
        applyFilter(typeSelect.value);
    }

    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", init);
    } else {
        init();
    }
})();
