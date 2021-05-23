var Chance = require('chance');
var chance = new Chance();
console.log("Bonjour " + chance.animal());

var express = require('express');
var app = express();

app.get('/', function(req, res){
	res.send(generateAnimalsIncredible());
});


app.listen(3000, function(){
  console.log("Accepte requête http sur le port 3000");
});

function generateAnimalsIncredible(){
	var numberOfAnimals = chance.integer({
		min:0,
		max:10
	});
	console.log(numberOfAnimals);
	var animals = [];
	
	for(var i = 0; i < numberOfAnimals; ++i){
		var espece = chance.animal();
		var address = chance.address();
		var phone = chance.phone();
		var prime = chance.prime();
		var ipv6 = chance.ipv6();
		animals.push({
			espece:espece,
			address:address,
			phone:phone,
			prime:prime,
			ipv6:ipv6
		});
	}
	console.log(animals);
	return animals;
}
