function printArea(div) {
     var printContents = document.head.innerHTML+document.getElementById(div).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}