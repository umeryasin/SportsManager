<?php
            $connect = mysqli_connect("localhost", "root", "", "db_pointofsale");
            $current_date1 = date('Y-m-d');
            $sql5 = "SELECT SUM(GrandTotal) AS GrandTotal FROM Invoice_master WHERE Date = '$current_date1'";
            print_r($sql5);
            exit();
            $run5 = mysqli_query($connect,$sql5);
            $chart_data = '';
            while($row = mysqli_fetch_array($run5))
            {
            $chart_data = "{ GrandTotal:'".$row["GrandTotal"]."'}";
            }
            $chart_data = substr($chart_data, 0, -2);
            ?>