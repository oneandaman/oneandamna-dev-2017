<?php
session_start();

if (isset($_SESSION['backend_user_id']))
{
    $now = time();
    if ($now > $_SESSION['backend_user_time'])
    {
        session_destroy();
        ?>
        <meta http-equiv='refresh' content='0;URL=login.php'>
        <?php
    }
    else
    {

        include_once 'header.php';
        ?>
        <h1>
            Restaurants
        </h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active">Restaurants</li>
        </ol>
        <?php
        include_once 'topic.php';
        ?>
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-2"></div>
            <div class="col-sm-2"></div>
            <div class="col-sm-2"></div>
            <div class="col-sm-1"></div>
            <div class="col-sm-1"><button id="btn_create">Create</button></div>
            <div class="col-sm-1"><button id="btn_edit">Edit</button></div>
            <div class="col-sm-1"><button id="btn_preview">Preview</button></div>
        </div>
        <div id='jqxTabs'>
            <ul>
                <li style="margin-left: 30px;">ภาษาไทย</li>
                <li>English</li>

            </ul>
            <div>
                <div class="row">
                    <div class="col-sm-12">
                        <div style="width: 5px; height: 5px;"></div>
                        <div id='grid_dash_th'></div>
                    </div>
                </div>
            </div>
            <div>
                <div class="row">
                    <div class="col-sm-12">
                        <div style="width: 5px; height: 5px;"></div>
                        <div id='grid_dash_en'></div>
                    </div>
                </div>
            </div>

        </div>   
        <?php
        include_once 'script.php';
        ?>

        <script type="text/javascript">
            $(document).ready(function ()
            {
                /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                // ใส่ javascript ตรงนี้
                var theme = 'energyblue';

                $("#btn_create").jqxButton({theme: theme, width: '100%', height: 30});
                $("#btn_edit").jqxButton({theme: theme, width: '100%', height: 30});
                $("#btn_preview").jqxButton({theme: theme, width: '100%', height: 30});

                // prepare the data
                var url = "database/query.php";
                // prepare the data
                var source =
                        {
                            datatype: "json",
                            datafields: [
                                {name: 'restaurant_id'},
                                {name: 'restaurant_status'},
                                {name: 'restaurant_name'},
                                {name: 'restaurant_status'},
                                {name: 'restaurant_district_id'},
                                {name: 'restaurant_province_id'}
                            ],
                            url: url,
                            async: false,
                            type: 'POST',
                            data:
                                    {
                                        fc: 'get_restaurant',
                                        lag: 'th'
                                    }
                        };
                var dataAdapter = new $.jqx.dataAdapter(source);

                $("#grid_dash_th").jqxGrid(
                        {
                            width: '100%',
                            height: '420px',
                            pagermode: "simple",
                            pageable: true,
                            source: dataAdapter,
                            theme: theme,
                            columnsresize: true,
                            columnsheight: 40,
                            rowsheight: 34,
                            columns: [
                                {text: 'รหัส', dataField: 'restaurant_id', align: 'center', cellsalign: 'center', minwidth: 64, width: '30%'},
                                {text: 'สถานะ', dataField: 'restaurant_status', align: 'center', minwidth: 74.5, width: '15%'},
                                {text: 'ชื่อ', dataField: 'restaurant_name', align: 'center', minwidth: 74.5, width: '25%'},
                                {text: 'อำเภอ', dataField: 'restaurant_district_id', align: 'center', cellsalign: 'center', minwidth: 64, width: '15%'},
                                {text: 'จังหวัด', dataField: 'restaurant_province_id', align: 'center', cellsalign: 'center', minwidth: 64, width: '15%'}
                            ]
                        });




                ////////////////////////////////////////////////
                // prepare the data
                // prepare the data
                var url = "database/query.php";
                // prepare the data
                var source =
                        {
                            datatype: "json",
                            datafields: [
                                {name: 'restaurant_id'},
                                {name: 'restaurant_status'},
                                {name: 'restaurant_name'},
                                {name: 'restaurant_status'},
                                {name: 'restaurant_district_id'},
                                {name: 'restaurant_province_id'}
                            ],
                            url: url,
                            async: false,
                            type: 'POST',
                            data:
                                    {
                                        fc: 'get_restaurant',
                                        lag: 'en'
                                    }
                        };
                var dataAdapter = new $.jqx.dataAdapter(source);

                $("#grid_dash_en").jqxGrid(
                        {
                            width: '100%',
                            height: '420px',
                            pagermode: "simple",
                            pageable: true,
                            source: dataAdapter,
                            theme: theme,
                            columnsresize: true,
                            columnsheight: 40,
                            rowsheight: 34,
                            columns: [
                                {text: 'รหัส', dataField: 'restaurant_id', align: 'center', cellsalign: 'center', minwidth: 64, width: '30%'},
                                {text: 'สถานะ', dataField: 'restaurant_status', align: 'center', minwidth: 74.5, width: '15%'},
                                {text: 'ชื่อ', dataField: 'restaurant_name', align: 'center', minwidth: 74.5, width: '25%'},
                                {text: 'อำเภอ', dataField: 'restaurant_district_id', align: 'center', cellsalign: 'center', minwidth: 64, width: '15%'},
                                {text: 'จังหวัด', dataField: 'restaurant_province_id', align: 'center', cellsalign: 'center', minwidth: 64, width: '15%'}
                            ]
                        });


                $('#jqxTabs').jqxTabs({width: '100%', height: '100%', position: 'top', theme: theme});
                $('#jqxTabs').jqxTabs({height: '100%'});


                $("#btn_create").on('click', function ()
                {
                    window.open("restaurant_form.php", "_self");
                });
                // จบใส่ javascript
                /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            });
        </script>
        <?php
        include_once 'footer.php';
    }//End Check Time Out
}//End Check Session
else
{
    ?>
    <meta http-equiv='refresh' content='0;URL=login.php'>
    <?php
}