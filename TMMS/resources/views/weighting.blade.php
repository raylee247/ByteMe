<!doctype html>
    <html lang="en">

<head>
    <script>
        function allowDrop(ev) {
            ev.preventDefault();
        }

        function drag(ev) {
            ev.dataTransfer.setData("text", ev.target.id);
        }

        function drop(ev) {
            ev.preventDefault();
            var data = ev.dataTransfer.getData("text");
            ev.target.appendChild(document.getElementById(data));
        }
        function dragStart(ev) {
            ev.dataTransfer.effectAllowed='move';
            ev.dataTransfer.setData("Text", ev.target.getAttribute('id'));   ev.dataTransfer.setDragImage(ev.target,100,100);
            return true;
        }
        function dragEnter(ev) {
            ev.preventDefault();
            return true;
        }
        function dragOver(ev) {
            ev.preventDefault();
        }
        function dragDrop(ev) {
            var data = ev.dataTransfer.getData("Text");
            ev.target.appendChild(document.getElementById(data));
            ev.stopPropagation();
            return false;
        }
    </script>
</head>

<body>
    <p1>
        Drag UI will make later
        <div id="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></div>

        <img id="drag1" src="img_logo.gif" draggable="true"
             ondragstart="drag(event)" width="336" height="69">
    </p1>

</body>

</html>