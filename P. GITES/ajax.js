Check();
function Check() {
    var order = document.getElementById('SelectFilter');
    var category = document.getElementsByName('boxCategory[]');
    var specificity = document.getElementsByName('boxSpecificity[]');
    var bedroom = document.getElementsByName('boxBedroom[]');
    var bathroom = document.getElementsByName('boxBathroom[]');
    var arrayData = { 'SelectFilter': [], 'boxCategory': [], 'boxSpecificity': [], 'boxBedroom': [], 'boxBathroom': [] };

    for (var i = 0; i < specificity.length; i++) {

        if (category[i]) {
            category[i].addEventListener('change', function () {
                if (this.checked) {
                    arrayData['boxCategory'].push(this.value);
                } else if (arrayData['boxCategory'].indexOf(this.value) >= 0) {
                    arrayData['boxCategory'].splice(arrayData['boxCategory'].indexOf(this.value), 1)
                }
                loadData(arrayData);
            });
        }

        if (specificity[i]) {
            specificity[i].addEventListener('change', function () {
                if (this.checked) {
                    arrayData['boxSpecificity'].push(this.value);
                } else if (arrayData['boxSpecificity'].indexOf(this.value) >= 0) {
                    arrayData['boxSpecificity'].splice(arrayData['boxSpecificity'].indexOf(this.value), 1)
                }
                loadData(arrayData);
            });
        } 

        if (bedroom[i]) {
            bedroom[i].addEventListener('change', function () {
                if (this.checked) {
                    arrayData['boxBedroom'].push(this.value);
                } else if (arrayData['boxBedroom'].indexOf(this.value) >= 0) {
                    arrayData['boxBedroom'].splice(arrayData['boxBedroom'].indexOf(this.value), 1)
                }
                loadData(arrayData);
            });
        }

        if (bathroom[i]) {
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
}


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