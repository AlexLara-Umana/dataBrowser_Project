var collection;
var index;

// form handler
const form = document.getElementById("query-form");
const query = document.getElementById("query");
const insert = document.getElementById("insert");
query.addEventListener('click', function(event) {
  event.preventDefault();

  // format form data
  const formData = new FormData(form);
  queryDB(formData);
});
insert.addEventListener('click', function(event) {
  event.preventDefault();
  
  // format form data
  const formData = new FormData(form);
  insertDB(formData);
});

async function queryDB(formData) {
  fetch('Query.php', {
    method: 'POST',
    body: formData
  })
  .then((response) => {
    if (!response.ok) {
      throw response;
    }
    return response.json();
  }).then((json) => {
    handleQueryResponse(json);
  }).catch((err) => {
    console.error(err);
  });
}

async function insertDB(formData) {
  fetch('Insert.php', {
    method: 'POST',
    body: formData
  })
  .then((response) => {
    if (!response.ok) {
      throw response;
    }
    return response.json();
  }).then((json) => {
    console.log(json);
    handleInsertResponse(json);
  }).catch((err) => {
    console.error(err);
  });
}

function handleQueryResponse(response) {
  response = response["collection"];
  collection = response;
  setChampionAttributes(collection[0]);
  index = 0;
}

function handleInsertResponse(response) {

}

// variables html elements
const numhtml = document.getElementById("disp-number");
const namehtml = document.getElementById("disp-name");
const originhtml = document.getElementById("disp-origin");
const classhtml = document.getElementById("disp-class");
const aliashtml = document.getElementById("disp-alias");
const rolehtml = document.getElementById("disp-role");
const imghtml = document.getElementById("disp-champion-img");

// event listeners for scroll buttons
const scroll_start = document.getElementById("scroll-start");
scroll_start.addEventListener('click', function() {jumpToScrollStart()});
const scroll_prev = document.getElementById("scroll-prev");
scroll_prev.addEventListener('click', function() {collectionScroll(-1)});
const scroll_next = document.getElementById("scroll-next");
scroll_next.addEventListener('click', function() {collectionScroll(1)});
const scroll_end = document.getElementById("scroll-end");
scroll_end.addEventListener('click', function() {jumpToScrollEnd()});

function collectionScroll(direction) {
  index += direction;
  if (index < 0) {
    index += collection.length;
  } else if (index >= collection.length) {
    index %= collection.length;
  }
  setChampionAttributes(collection[index]);
}

function jumpToScrollStart() {
  index = 0;
  setChampionAttributes(collection[index]);
}

function jumpToScrollEnd() {
  index = collection.length - 1;
  setChampionAttributes(collection[index]);
}

function resetChampionAttributes() {
  numhtml.innerHTML = "???";
  namehtml.innerHTML = "???";
  originhtml.innerHTML = "???";
  classhtml.innerHTML = "???";
  aliashtml.innerHTML = "???";
  rolehtml.style.width = "???";
  imghtml.src = "./Data/Images/Placeholder.png";
}

function setChampionAttributes(Champion) {
  if (collection.length < 1) {
    resetChampionAttributes();
    return;
  }

  function calcBarWidth(htmlelem) {
    return parseInt(100 * (parseInt(htmlelem.innerText) / 255));
  }

  numhtml.innerHTML = Champion.num;
  namehtml.innerHTML = Champion.name;
  originhtml.innerHTML = Champion.origin;
  classhtml.innerHTML = Champion.class;
  aliashtml.innerHTML = Champion.alias;
  rolehtml.innerHTML = Champion.role;
  imghtml.src = "./Data/Images/" + Champion.num + ".png";
}
