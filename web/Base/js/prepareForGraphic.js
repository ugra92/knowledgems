var words = [];
var counts = [];

var tagWords= [];
var tagsNum= [];

function analize(result) {
    for (var i=0; i<result.length; i++) {
        if (array_contains(words, result[i])) {
            counts[result[i]]++;
        } else {
            words.push(result[i]);
            counts[result[i]] = 1;
        }
    }
    separateArrays(counts);
}

function array_contains(array, value) {
    for (var i=0; i<array.length; i++)
        if (array[i] == value)
            return true;
    return false;
}

function separateArrays(data){
    for (var property in data) {
        if ( ! data.hasOwnProperty(property)) {
            continue;
        }
        tagWords.push(property);
        tagsNum.push(data[property]);
    }
    console.log(tagWords);
    console.log(tagsNum);
}
