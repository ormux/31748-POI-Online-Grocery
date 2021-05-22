let categoriesMap = document.getElementById('map-categories');
let categoriesImg = document.getElementById('categories');

let frozenFoodMap = document.getElementById('map-frozen-food');
let frozenFoodImg = document.getElementById('frozen-food');

let freshFoodMap = document.getElementById('map-fresh-food');
let freshFoodImg = document.getElementById('fresh-food');

let beveragesMap = document.getElementById('map-beverages');
let beveragesImg = document.getElementById('beverages');

let homeHealthMap = document.getElementById('map-home-health');
let homeHealthImg = document.getElementById('home-health');

let petFoodMap = document.getElementById('map-pet-food');
let petFoodImg = document.getElementById('pet-food');

let categoriesScale = new ImageMapScale(categoriesMap, categoriesImg, 499);
let frozenFoodScale = new ImageMapScale(frozenFoodMap, frozenFoodImg, 499);
let freshFoodScale = new ImageMapScale(freshFoodMap, freshFoodImg, 499);
let beveragesScale = new ImageMapScale(beveragesMap, beveragesImg, 499);
let homeHealthScale = new ImageMapScale(homeHealthMap, homeHealthImg, 499);
let petFoodScale = new ImageMapScale(petFoodMap, petFoodImg, 499);
