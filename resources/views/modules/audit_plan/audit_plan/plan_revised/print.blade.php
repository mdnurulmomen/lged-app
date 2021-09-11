<body style="margin-top: 15px" onLoad="window.print();" onclick="window.close();">

{{--onclick="window.close();"--}}
<style type="text/css" media="print">
    @media print {
        /*remove extra texts from top and bottom */
        @page {
            size: auto;
            margin: 50px 0 50px 0;
        }

        body {
            font: 14px/1.4 Georgia, serif;
            width: 730px;
            padding: 50px;
        }

        /*.objective-outcome{
            display: table-cell;
            text-align: center;
            vertical-align: middle;
            width: 50%;
            padding: 1rem;
        }*/
    }
</style>
<div class="pdf-screen" style="height: 100%">
    {!! $cover['content'] !!}
</div>
<div class="pdf-screen">
    @foreach($plans as $plan)
        <div class="plan_content">
            {!! $plan['content'] !!}
        </div>
    @endforeach
</div>
</body>

