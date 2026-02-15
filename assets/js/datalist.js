// datalist.js

// DOM Elements
const searchTypeEl = document.getElementById('searchType');
const searchValueInput = document.getElementById('searchValueInput');
const searchValueList = document.getElementById('searchValueList');
const resetBtn = document.getElementById('resetBtn');

// Data arrays passed from PHP
const services = window.services || [];
const names = window.names || [];
const designations = window.designations || [];
const cadres = window.cadres || [];
const offices = window.offices || [];
const countries = window.countries || [];
const funds = window.funds || [];
const purposes = window.purposes || [];

let selectedType  = window.selectedType || '';
let selectedValue = window.selectedValue || '';

// Populate datalist based on search type
function populateDatalist() {
    searchValueList.innerHTML = '';
    let arr = [];
    switch(searchTypeEl.value){
        case 'service_id': arr = services; break;
        case 'name':       arr = names; break;
        case 'designation':arr = designations; break;
        case 'cadre':      arr = cadres; break;
        case 'office':     arr = offices; break;
        case 'country':    arr = countries; break;
        case 'fund':       arr = funds; break;
        case 'purpose':    arr = purposes; break;
    }

    arr.forEach(val => {
        const option = document.createElement('option');
        option.value = val;
        searchValueList.appendChild(option);
    });

    searchValueInput.value = selectedType === searchTypeEl.value ? selectedValue : '';
}

// Initial population
populateDatalist();

// Update datalist when search type changes
searchTypeEl.addEventListener('change', function() {
    selectedType = searchTypeEl.value;
    selectedValue = '';
    populateDatalist();
});


