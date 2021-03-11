loadData();
function loadData() {

    var httpRequest = new XMLHttpRequest();
    var specificity = document.getElementsByName('box[]');
    var arraySpecificity = [];


    for (var i = 0; i < specificity.length; i++) {
        specificity[i].addEventListener('change', function () {
            if (this.checked) {
                arraySpecificity.push(this.value);
                
                alert(arraySpecificity);
                console.log(arraySpecificity);

                httpRequest.open('POST', 'ajax/selectsearch.php', true);
                httpRequest.setRequestHeader("Content-Type", "application/json");
                httpRequest.send(JSON.stringify(arraySpecificity));
                
            } else if (arraySpecificity.indexOf(this.value) >= 0) {
                arraySpecificity.splice(arraySpecificity.indexOf(this.value), 1)
            }
        });
    }
}


