<form action="#" method="post">
<table>
<tr>
    <td>Select a major: </td>
    <td>
        <select id="myselect" onchange="change_myselect(this.value)">
            <option value="1">Select Majors</option>
            <option value="EGR">EGR</option>
            <option value="PHY">PHY</option>
        </select>
    </td>               
</tr>
</table>
</form>

<p id="demo"></p>

<script type = "text/javascript" src = "js/jsonConvert.js"></script>