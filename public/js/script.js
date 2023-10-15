

 
const tabs = document.querySelectorAll(".tabs")
const activeClass = "font-medium border-b-2 border-blue-500 text-blue-500";
let currentTabs = 'video'
let tabContent = document.querySelector(`#${currentTabs}`)
 
tabs.forEach(el => {
  const target = el.dataset.tabs;
  if (currentTabs === target) {
      el.classList.add(...activeClass.split(" "));
  } else {
      el.classList.remove(...activeClass.split(" "));
  }

  el.addEventListener("click", (e) => {
      e.preventDefault();
      const target = e.currentTarget.dataset.tabs;
      currentTabs = target;

      tabs.forEach(tab => {
          const tabTarget = tab.dataset.tabs;

          if (currentTabs === tabTarget) {
              tab.classList.add(...activeClass.split(" "));
              document.querySelector(`#${currentTabs}`).classList.remove("hidden")
          } else {
              tab.classList.remove(...activeClass.split(" "));
              document.querySelector(`#${tabTarget}`).classList.add("hidden")
          }
      });

  });
});

 