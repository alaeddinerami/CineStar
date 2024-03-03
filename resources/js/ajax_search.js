//  document.addEventListener('DOMContentLoaded', function () {
//      var searchInput = document.getElementById('search_input');
//      searchInput.addEventListener('input', function () {
//          var searchText = this.value;
//          var xhr = new XMLHttpRequest();
//          xhr.onreadystatechange = function () {
//              if (xhr.readyState == 4 && xhr.status == 200) {              console.log(xhr.responseText);
//                  document.querySelector('.ALL').innerHTML = xhr.responseText;
//              }
//          }
//          xhr.open('GET', '/search?search=' + searchText, true);
//          xhr.send();
//      });
//  });
