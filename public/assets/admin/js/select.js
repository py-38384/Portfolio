const multiselect_element = document.querySelector("#select-state");
const children = multiselect_element.children;
const name = multiselect_element.getAttribute("name");
const data = [];

function createTag(innerText){
    const tag = document.createElement("div");
    tag.classList.add('tag');
    tag.innerHTML = `
                        <span>${innerText}</span>
                        <span class="tag-remove"> <span></span> <span></span> </span>
    `;
    return tag
}

Array.from(children).forEach((child) => {
    const value = child.value;
    const innerHTML = child.innerHTML;
    data.push({ value, innerHTML });
});

const base_container = document.createElement("div");
base_container.classList.add("select_base_container");

const select_display = document.createElement("div");

select_display.classList.add("select_display");
const select_display_input = document.createElement("input");


const select_and_search_container = document.createElement("div");
select_and_search_container.classList.add("select_and_search_container");

const tag_container = document.createElement("div");
tag_container.classList.add('tag_container');

const tag1 = createTag("Alabama");
const tag2 = createTag("Alaska");

tag_container.append(tag1,tag2)
select_display.append(tag_container,select_display_input);

const select_search_input = document.createElement("input");
select_search_input.placeholder = "Search..";
select_search_input.classList.add("select_search_input");

const select_option_container = document.createElement("div");
select_option_container.classList.add("select_option_container");

data.forEach((ele) => {
    const select_option = document.createElement("div");
    select_option.classList.add("select_option");
    select_option.setAttribute("name", ele.value);
    select_option.innerHTML = ele.innerHTML;
    select_option_container.append(select_option);
});

select_and_search_container.append(select_search_input);
select_and_search_container.append(select_option_container);

base_container.append(select_display);
base_container.append(select_and_search_container);

const parentElement = multiselect_element.parentElement;
multiselect_element.style.display = "none";
parentElement.append(base_container);
