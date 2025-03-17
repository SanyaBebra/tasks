'use strict';

document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
  console.log(checkbox);
  checkbox.addEventListener('change', () => {
    checkbox.nextElementSibling.style.textDecoration = checkbox.checked ? "line-through" : "none";
  });
});