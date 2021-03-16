Check();
function Check() {

    var category = document.getElementsByName('boxCategory[]');
    var specificity = document.getElementsByName('boxSpecificity[]');
    var bedroom = document.getElementsByName('boxBedroom[]');
    var bathroom = document.getElementsByName('boxBathroom[]');
    var arrayData = { 'boxCategory': [], 'boxSpecificity': [], 'boxBedroom': [], 'boxBathroom': [] };


    for (var i = 0; i < category.length; i++) {
        category[i].addEventListener('change', function () {
            if (this.checked) {
                arrayData['boxCategory'].push(this.value);
            } else if (arrayData['boxCategory'].indexOf(this.value) >= 0) {
                arrayData['boxCategory'].splice(arrayData['boxCategory'].indexOf(this.value), 1)
            }
            loadData(arrayData);
        });

        specificity[i].addEventListener('change', function () {
            if (this.checked) {
                arrayData['boxSpecificity'].push(this.value);
            } else if (arrayData['boxSpecificity'].indexOf(this.value) >= 0) {
                arrayData['boxSpecificity'].splice(arrayData['boxSpecificity'].indexOf(this.value), 1)
            }
            loadData(arrayData);
        });

        bedroom[i].addEventListener('change', function () {
            if (this.checked) {
                arrayData['boxBedroom'].push(this.value);
            } else if (arrayData['boxBedroom'].indexOf(this.value) >= 0) {
                arrayData['boxBedroom'].splice(arrayData['boxBedroom'].indexOf(this.value), 1)
            }
            loadData(arrayData);
        });

        bathroom[i].addEventListener('change', function () {
            if (this.checked) {
                arrayData['boxBathroom'].push(this.value);
            } else if (arrayData['boxBathroom'].indexOf(this.value) >= 0) {
                arrayData['boxBathroom'].splice(arrayData['boxBathroom'].indexOf(this.value), 1)
            }
            loadData(arrayData);
        });
    }
}

var selectElem = document.getElementById('SelectFilter');
selectElem.addEventListener('change', function () {
    if (this.checked) {
        arrayData['boxBathroom'].push(this.value);
    } else if (arrayData['boxBathroom'].indexOf(this.value) >= 0) {
        arrayData['boxBathroom'].splice(arrayData['boxBathroom'].indexOf(this.value), 1)
    }
    loadData(arrayData);
});







// Quand une nouvelle <option> est selectionnée
selectElem.addEventListener('change', function () {
    var index = this.value;
    var httpRequest = new XMLHttpRequest();

    httpRequest.onreadystatechange = function () {
        if (httpRequest.readyState == 4 && httpRequest.status == 200) {
            console.log(httpRequest.response);

        } else if (httpRequest.readyState < 4) {
            console.log('Pas ok');
        }
    };
    httpRequest.open('POST', 'selectsearch.php', true);
    httpRequest.setRequestHeader("Content-Type", "application/json");
    httpRequest.send(JSON.stringify(arrayData));
    alert(index);
})


function loadData(arrayData) {
    let blockReponse = document.getElementById('result');

    var httpRequest = new XMLHttpRequest();

    httpRequest.onreadystatechange = function () {
        if (httpRequest.readyState == 4 && httpRequest.status == 200) {
            console.log(httpRequest.response);
            blockReponse.innerHTML = httpRequest.response;

        } else if (httpRequest.readyState < 4) {
            console.log('Pas ok');
        }
    };
    httpRequest.open('POST', 'selectsearch.php', true);
    httpRequest.setRequestHeader("Content-Type", "application/json");
    httpRequest.send(JSON.stringify(arrayData));
}