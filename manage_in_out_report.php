


<script>
    $(function () {
        $("#view_report").on('click', function () {
            $.Dialog({
                shadow: true,
                overlay: false,
                draggable: true,
                icon: '<span class="icon-user"></span>',
                title: 'Draggable window',
                width: 700,
                padding: 10,
                content: 'ADD YOU RELATIVES.',
                onShow: function () {
                    var content = ' <form method="post" action="">' +
                            '<div class="grid">' +
                            // start
                            '<div class="row">' +
                            ' <div class="span8">' +
                            '<div class="span1">' +
                            '<label>file No.</label>' +
                            '</div>' +
                            '<div class = "span3">' +
                            '<div class = "input-control text" data - role = "input-control">' +
                            '<input placeholder = "" type = "text"  name = "payroll_no">' +
                            ' <button type = "button" class = "btn-clear" tabindex = "-1" > </button>' +
                            '</div>' +
                            '</div> ' +
                            '<div class="span1">' +
                            '<label>submitter</label>' +
                            '</div>' +
                            '<div class = "span3">' +
                            '<div class = "input-control text" data - role = "input-control">' +
                            '<input placeholder = "" type = "text" name = "st_salary">' +
                            '<button type = "button" class = "btn-clear" tabindex = "-1"> </button>' +
                            '</div>' +                          
                            '</div>' +                           
                            '</div>' + 
                            '</div>' +
//                            end 
                             // start
                            '<div class="row">' +
                            ' <div class="span8">' +
                            '<div class="span1">' +
                            '<label>Department</label>' +
                            '</div>' +
                            '<div class = "span3">' +
                            '<div class = "input-control text" data - role = "input-control">' +
                            '<input placeholder = "" type = "text"  name = "payroll_no">' +
                            ' <button type = "button" class = "btn-clear" tabindex = "-1" > </button>' +
                            '</div>' +
                            '</div> ' +
                            '<div class="span1">' +
                            '<label>submit date</label>' +
                            '</div>' +
                            '<div class = "span3">' +
                            '<div class = "input-control text" data - role = "input-control">' +
                            '<input placeholder = "" type = "text" name = "st_salary">' +
                            '<button type = "button" class = "btn-clear" tabindex = "-1"> </button>' +
                            '</div>' +                          
                            '</div>' +                           
                            '</div>' + 
                            '</div>' +
//                            end 
                                                        // start
                            '<div class="row">' +
                            ' <div class="span8">' +
                            '<div class="span2">' +
                            '<label>Report Title</label>' +
                            '</div>' +
                            '<div class = "span6">' +
                            '<div class = "input-control text" data - role = "input-control">' +
                            '<input placeholder = "Payroll#" type = "text"  name = "payroll_no">' +
                            ' <button type = "button" class = "btn-clear" tabindex = "-1" > </button>' +
                            '</div>' +
                            '</div> ' +                           
                            '</div>' + 
                            '</div>' +
//                            end 
                            '<div class="row">' +
                             '<div class="form-actions">' +
                            '<button class="button primary" name="relatives">submit</button>&nbsp;' +
                            '<button class="button" type="button" onclick="$.Dialog.close()">Cancel</button> ' +
                            '</div>' +
                            '</div>' +
//                            end grid
                            '</div>' +
                            '</div>' +                         
                            '</form>';

                    $.Dialog.title("ADD YOU RELATIVES.");
                    $.Dialog.content(content);
                }

            });
        });
    })
</script>

<div class="shadow">
    <nav class="breadcrumbs">
        <ul>
            <li><a href="?action=attendence"><i class="icon-home"></i>Home</a></li>
        </ul>
    </nav>
</div>
<div class="margin5"> 
    <table id="example" class="display  striped bordered table hovered" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th class="text-left">file no</th>
                <th class="text-left">Report title</th>
                <th class="text-left">Status</th>
                <th class="text-left">Submitter</th>
                <th class="text-left">Submit date</th>                   
                <th class="text-left">Size</th>
                <th class="text-left">File type</th>

            </tr>
        </thead>

        <tbody>
            <tr class="">
                <td>SR001</td>
                <td class="right">Alarm progess report</td>
                <td class="right">verified</td>
                <td class="right">oisso</td>
                <td class="right">24/02/2015</td>                   
                <td class="right">20 Mb</td>
                <td class="right"><a href="#" id="view_report"><i class="icon-file-pdf fg-red"></i></a></td>

            </tr>       
            <tr class="">
                <td>SR002</td>
                <td class="right">Alarm progess report</td>
                <td class="right">unverified</td>
                <td class="right">oisso</td>
                <td class="right">24/02/2015</td>                   
                <td class="right">20 Mb</td>
                <td class="right"><a href="#"><i class="icon-file-word fg-active-blue"></i></a></td>

            </tr>       
            <tr class="">
                <td>SR003</td>
                <td class="right">Alarm progess report</td>
                <td class="right">verified</td>
                <td class="right">oisso</td>
                <td class="right">24/02/2015</td>                   
                <td class="right">20 Mb</td>
                <td class="right"><a href="#"><i class="icon-file-excel fg-green"></i></a></td>

            </tr>       
        </tbody>
    </table>
</div>

