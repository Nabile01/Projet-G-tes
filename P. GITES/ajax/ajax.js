loadData();
function loadData() {

    var httpRequest = new XMLHttpRequest();
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
            httpRequest.open('POST', 'ajax/selectsearch.php', true);
            httpRequest.setRequestHeader("Content-Type", "application/json");
            httpRequest.send(JSON.stringify(arrayData));
            console.log(arrayData);
        });
    }

    for (var i = 0; i < specificity.length; i++) {
        specificity[i].addEventListener('change', function () {
            if (this.checked) {
                arrayData['boxSpecificity'].push(this.value);
            } else if (arrayData['boxSpecificity'].indexOf(this.value) >= 0) {
                arrayData['boxSpecificity'].splice(arrayData['boxSpecificity'].indexOf(this.value), 1)
            }
            httpRequest.open('POST', 'ajax/selectsearch.php', true);
            httpRequest.setRequestHeader("Content-Type", "application/json");
            httpRequest.send(JSON.stringify(arrayData));
            console.log(arrayData);
        });
    }

    for (var i = 0; i < bedroom.length; i++) {
        bedroom[i].addEventListener('change', function () {
            if (this.checked) {
                arrayData['boxBedroom'].push(this.value);
            } else if (arrayData['boxBedroom'].indexOf(this.value) >= 0) {
                arrayData['boxBedroom'].splice(arrayData['boxBedroom'].indexOf(this.value), 1)
            }
            httpRequest.open('POST', 'ajax/selectsearch.php', true);
            httpRequest.setRequestHeader("Content-Type", "application/json");
            httpRequest.send(JSON.stringify(arrayData));
            console.log(arrayData);
        });
    }

    for (var i = 0; i < bathroom.length; i++) {
        bathroom[i].addEventListener('change', function () {
            if (this.checked) {
                arrayData['boxBathroom'].push(this.value);
            } else if (arrayData['boxBathroom'].indexOf(this.value) >= 0) {
                arrayData['boxBathroom'].splice(arrayData['boxBathroom'].indexOf(this.value), 1)
            }

            console.log(arrayData);
            httpRequest.open('POST', 'ajax/selectsearch.php', true);
            httpRequest.setRequestHeader("Content-Type", "application/json");
            httpRequest.send(JSON.stringify(arrayData));
        });
    }
}


    // loadData();
    // function loadData() {

    //     var httpRequest = new XMLHttpRequest();
    //     var specificity = document.getElementsByName('box[]');
    //     var arraySpecificity = [];
    //     var selectPrice = document.getElementsByName('selectPrice');
    //     var price = '';


    //     for (var i = 0; i < specificity.length; i++) {
    //         specificity[i].addEventListener('change', function () {
    //             if (this.checked) {
    //                 arraySpecificity.push(this.value);

    //                 alert(arraySpecificity);
    //                 console.log(arraySpecificity);

    //                 httpRequest.open('POST', 'ajax/selectsearch.php', true);
    //                 httpRequest.setRequestHeader("Content-Type", "application/json");
    //                 httpRequest.send(JSON.stringify(arraySpecificity));

    //             } else if (arraySpecificity.indexOf(this.value) >= 0) {
    //                 arraySpecificity.splice(arraySpecificity.indexOf(this.value), 1)
    //             }
    //         });
    //     }

    //     selectPrice.addEventListener('change', function () {
    //         if (this.checked) {
    //             price = this.value;

    //             alert(price);
    //             console.log(price);

    //             httpRequest.open('POST', 'ajax/selectsearch.php', true);
    //             httpRequest.setRequestHeader("Content-Type", "application/json");
    //             httpRequest.send(JSON.stringify(price));
    //         }
    //     });
    // }