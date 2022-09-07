<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    {{-- <link href="public/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/> --}}
    <style>
        html {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        body {
            margin: 0;
            font-family: nikoshpdf !important;
        }

        .bangla-font {
            font-family: nikoshpdf !important;
        }
        .bangla-bijoy {
            font-family: sutonnymj !important;
        }

        article,
        aside,
        details,
        figcaption,
        figure,
        footer,
        header,
        hgroup,
        main,
        menu,
        nav,
        section,
        summary {
            display: block;
        }

        audio,
        canvas,
        progress,
        video {
            display: inline-block;
            vertical-align: baseline;
        }

        audio:not([controls]) {
            display: none;
            height: 0;
        }

        [hidden],
        template {
            display: none;
        }

        a {
            background-color: transparent;
        }

        a:active,
        a:hover {
            outline: 0;
        }

        abbr[title] {
            border-bottom: none;
            text-decoration: underline;
            text-decoration: underline dotted;
        }

        b,
        strong {
            font-weight: bold;
        }

        dfn {
            font-style: italic;
        }

        h1 {
            font-size: 2em;
            margin: 0.67em 0;
        }

        mark {
            background: #ff0;
            color: #000;
        }

        small {
            font-size: 80%;
        }

        sub,
        sup {
            font-size: 75%;
            line-height: 0;
            position: relative;
            vertical-align: baseline;
        }

        sup {
            top: -0.5em;
        }

        sub {
            bottom: -0.25em;
        }

        img {
            border: 0;
        }

        svg:not(:root) {
            overflow: hidden;
        }

        figure {
            margin: 1em 40px;
        }

        hr {
            -webkit-box-sizing: content-box;
            -moz-box-sizing: content-box;
            box-sizing: content-box;
            height: 0;
        }

        pre {
            overflow: auto;
        }

        code,
        kbd,
        pre,
        samp {
            font-family: monospace, monospace;
            font-size: 1em;
        }

        button,
        input,
        optgroup,
        select,
        textarea {
            color: inherit;
            font: inherit;
            margin: 0;
        }

        button {
            overflow: visible;
        }

        button,
        select {
            text-transform: none;
        }

        button,
        html input[type="button"],
        input[type="reset"],
        input[type="submit"] {
            -webkit-appearance: button;
            cursor: pointer;
        }

        button[disabled],
        html input[disabled] {
            cursor: default;
        }

        button::-moz-focus-inner,
        input::-moz-focus-inner {
            border: 0;
            padding: 0;
        }

        input {
            line-height: normal;
        }

        input[type="checkbox"],
        input[type="radio"] {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            padding: 0;
        }

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            height: auto;
        }

        input[type="search"] {
            -webkit-appearance: textfield;
            -webkit-box-sizing: content-box;
            -moz-box-sizing: content-box;
            box-sizing: content-box;
        }

        input[type="search"]::-webkit-search-cancel-button,
        input[type="search"]::-webkit-search-decoration {
            -webkit-appearance: none;
        }

        fieldset {
            border: 1px solid #c0c0c0;
            margin: 0 2px;
            padding: 0.35em 0.625em 0.75em;
        }

        legend {
            border: 0;
            padding: 0;
        }

        textarea {
            overflow: auto;
        }

        optgroup {
            font-weight: bold;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
            font-family: nikoshpdf !important;
        }

        td,
        th {
            padding: 3px;
            font-family: nikoshpdf !important;
        }

        /*! Source: https://github.com/h5bp/html5-boilerplate/blob/master/src/css/main.css */
        @media print {

            *,
            *:before,
            *:after {
                color: #000 !important;
                text-shadow: none !important;
                background: transparent !important;
                -webkit-box-shadow: none !important;
                box-shadow: none !important;
            }

            a,
            a:visited {
                text-decoration: underline;
            }

            a[href]:after {
                content: " ("attr(href) ")";
            }

            abbr[title]:after {
                content: " ("attr(title) ")";
            }

            a[href^="#"]:after,
            a[href^="javascript:"]:after {
                content: "";
            }

            pre,
            blockquote {
                border: 1px solid #999;
                page-break-inside: avoid;
            }

            thead {
                display: table-header-group;
            }

            tr,
            img {
                page-break-inside: avoid;
            }

            img {
                max-width: 100% !important;
            }

            p,
            h2,
            h3 {
                orphans: 3;
                widows: 3;
            }

            .navbar {
                display: none;
            }

            .btn>.caret,
            .dropup>.btn>.caret {
                border-top-color: #000 !important;
            }

            .label {
                border: 1px solid #000;
            }

            .table {
                border-collapse: collapse !important;
            }

            .table td,
            .table th {
                background-color: #fff !important;
            }

            .table-bordered th,
            .table-bordered td {
                border: 1px solid #000000 !important;
            }
        }

        * {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        *:before,
        *:after {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        html {
            font-size: 14px;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        }

        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 18px;
            line-height: 1.42857143;
            color: #333333;
            background-color: #ffffff;
        }

        input,
        button,
        select,
        textarea {
            font-family: inherit;
            font-size: inherit;
            line-height: inherit;
        }

        a {
            color: #337ab7;
            text-decoration: none;
        }

        a:hover,
        a:focus {
            color: #23527c;
            text-decoration: underline;
        }

        a:focus {
            outline: 5px auto -webkit-focus-ring-color;
            outline-offset: -2px;
        }

        figure {
            margin: 0;
        }

        img {
            vertical-align: middle;
        }

        .img-responsive {
            display: block;
            max-width: 100%;
            height: auto;
        }

        .img-rounded {
            border-radius: 6px;
        }

        .img-thumbnail {
            padding: 4px;
            line-height: 1.42857143;
            background-color: #ffffff;
            border: 1px solid #dddddd;
            border-radius: 4px;
            -webkit-transition: all 0.2s ease-in-out;
            -o-transition: all 0.2s ease-in-out;
            transition: all 0.2s ease-in-out;
            display: inline-block;
            max-width: 100%;
            height: auto;
        }

        .img-circle {
            border-radius: 50%;
        }

        hr {
            margin-top: 20px;
            margin-bottom: 20px;
            border: 0;
            border-top: 1px solid #eeeeee;
        }

        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            border: 0;
        }

        .sr-only-focusable:active,
        .sr-only-focusable:focus {
            position: static;
            width: auto;
            height: auto;
            margin: 0;
            overflow: visible;
            clip: auto;
        }

        [role="button"] {
            cursor: pointer;
        }

        table {
            background-color: transparent;
        }

        table col[class*="col-"] {
            position: static;
            display: table-column;
            float: none;
        }

        table td[class*="col-"],
        table th[class*="col-"] {
            position: static;
            display: table-cell;
            float: none;
        }

        caption {
            padding-top: 8px;
            padding-bottom: 8px;
            color: #777777;
            text-align: left;
        }

        th {
            text-align: left;
        }

        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 20px;
        }

        .table>thead>tr>th,
        .table>tbody>tr>th,
        .table>tfoot>tr>th,
        .table>thead>tr>td,
        .table>tbody>tr>td,
        .table>tfoot>tr>td {
            padding: 8px;
            line-height: 1.42857143;
            vertical-align: top;
            border-top: 1px solid #dddddd;
        }

        .table>thead>tr>th {
            vertical-align: bottom;
            border-bottom: 2px solid #dddddd;
        }

        .table>caption+thead>tr:first-child>th,
        .table>colgroup+thead>tr:first-child>th,
        .table>thead:first-child>tr:first-child>th,
        .table>caption+thead>tr:first-child>td,
        .table>colgroup+thead>tr:first-child>td,
        .table>thead:first-child>tr:first-child>td {
            border-top: 0;
        }

        .table>tbody+tbody {
            border-top: 2px solid #dddddd;
        }

        .table .table {
            background-color: #ffffff;
        }

        .table-condensed>thead>tr>th,
        .table-condensed>tbody>tr>th,
        .table-condensed>tfoot>tr>th,
        .table-condensed>thead>tr>td,
        .table-condensed>tbody>tr>td,
        .table-condensed>tfoot>tr>td {
            padding: 5px;
        }

        .table-bordered {
            border: 1px solid #000000;
        }

        .table-bordered>thead>tr>th,
        .table-bordered>tbody>tr>th,
        .table-bordered>tfoot>tr>th,
        .table-bordered>thead>tr>td,
        .table-bordered>tbody>tr>td,
        .table-bordered>tfoot>tr>td {
            border: 1px solid #000000;
        }

        .table-bordered>thead>tr>th,
        .table-bordered>thead>tr>td {
            border-bottom-width: 2px;
        }

        .table-striped>tbody>tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }

        .table-hover>tbody>tr:hover {
            background-color: #f5f5f5;
        }

        .table>thead>tr>td.active,
        .table>tbody>tr>td.active,
        .table>tfoot>tr>td.active,
        .table>thead>tr>th.active,
        .table>tbody>tr>th.active,
        .table>tfoot>tr>th.active,
        .table>thead>tr.active>td,
        .table>tbody>tr.active>td,
        .table>tfoot>tr.active>td,
        .table>thead>tr.active>th,
        .table>tbody>tr.active>th,
        .table>tfoot>tr.active>th {
            background-color: #f5f5f5;
        }

        .table-hover>tbody>tr>td.active:hover,
        .table-hover>tbody>tr>th.active:hover,
        .table-hover>tbody>tr.active:hover>td,
        .table-hover>tbody>tr:hover>.active,
        .table-hover>tbody>tr.active:hover>th {
            background-color: #e8e8e8;
        }

        .table>thead>tr>td.success,
        .table>tbody>tr>td.success,
        .table>tfoot>tr>td.success,
        .table>thead>tr>th.success,
        .table>tbody>tr>th.success,
        .table>tfoot>tr>th.success,
        .table>thead>tr.success>td,
        .table>tbody>tr.success>td,
        .table>tfoot>tr.success>td,
        .table>thead>tr.success>th,
        .table>tbody>tr.success>th,
        .table>tfoot>tr.success>th {
            background-color: #dff0d8;
        }

        .table-hover>tbody>tr>td.success:hover,
        .table-hover>tbody>tr>th.success:hover,
        .table-hover>tbody>tr.success:hover>td,
        .table-hover>tbody>tr:hover>.success,
        .table-hover>tbody>tr.success:hover>th {
            background-color: #d0e9c6;
        }

        .table>thead>tr>td.info,
        .table>tbody>tr>td.info,
        .table>tfoot>tr>td.info,
        .table>thead>tr>th.info,
        .table>tbody>tr>th.info,
        .table>tfoot>tr>th.info,
        .table>thead>tr.info>td,
        .table>tbody>tr.info>td,
        .table>tfoot>tr.info>td,
        .table>thead>tr.info>th,
        .table>tbody>tr.info>th,
        .table>tfoot>tr.info>th {
            background-color: #d9edf7;
        }

        .table-hover>tbody>tr>td.info:hover,
        .table-hover>tbody>tr>th.info:hover,
        .table-hover>tbody>tr.info:hover>td,
        .table-hover>tbody>tr:hover>.info,
        .table-hover>tbody>tr.info:hover>th {
            background-color: #c4e3f3;
        }

        .table>thead>tr>td.warning,
        .table>tbody>tr>td.warning,
        .table>tfoot>tr>td.warning,
        .table>thead>tr>th.warning,
        .table>tbody>tr>th.warning,
        .table>tfoot>tr>th.warning,
        .table>thead>tr.warning>td,
        .table>tbody>tr.warning>td,
        .table>tfoot>tr.warning>td,
        .table>thead>tr.warning>th,
        .table>tbody>tr.warning>th,
        .table>tfoot>tr.warning>th {
            background-color: #fcf8e3;
        }

        .table-hover>tbody>tr>td.warning:hover,
        .table-hover>tbody>tr>th.warning:hover,
        .table-hover>tbody>tr.warning:hover>td,
        .table-hover>tbody>tr:hover>.warning,
        .table-hover>tbody>tr.warning:hover>th {
            background-color: #faf2cc;
        }

        .table>thead>tr>td.danger,
        .table>tbody>tr>td.danger,
        .table>tfoot>tr>td.danger,
        .table>thead>tr>th.danger,
        .table>tbody>tr>th.danger,
        .table>tfoot>tr>th.danger,
        .table>thead>tr.danger>td,
        .table>tbody>tr.danger>td,
        .table>tfoot>tr.danger>td,
        .table>thead>tr.danger>th,
        .table>tbody>tr.danger>th,
        .table>tfoot>tr.danger>th {
            background-color: #f2dede;
        }

        .table-hover>tbody>tr>td.danger:hover,
        .table-hover>tbody>tr>th.danger:hover,
        .table-hover>tbody>tr.danger:hover>td,
        .table-hover>tbody>tr:hover>.danger,
        .table-hover>tbody>tr.danger:hover>th {
            background-color: #ebcccc;
        }

        .table-responsive {
            min-height: .01%;
            overflow-x: auto;
        }

        @media screen and (max-width: 767px) {
            .table-responsive {
                width: 100%;
                margin-bottom: 15px;
                overflow-y: hidden;
                -ms-overflow-style: -ms-autohiding-scrollbar;
                border: 1px solid #dddddd;
            }

            .table-responsive>.table {
                margin-bottom: 0;
            }

            .table-responsive>.table>thead>tr>th,
            .table-responsive>.table>tbody>tr>th,
            .table-responsive>.table>tfoot>tr>th,
            .table-responsive>.table>thead>tr>td,
            .table-responsive>.table>tbody>tr>td,
            .table-responsive>.table>tfoot>tr>td {
                white-space: nowrap;
            }

            .table-responsive>.table-bordered {
                border: 0;
            }

            .table-responsive>.table-bordered>thead>tr>th:first-child,
            .table-responsive>.table-bordered>tbody>tr>th:first-child,
            .table-responsive>.table-bordered>tfoot>tr>th:first-child,
            .table-responsive>.table-bordered>thead>tr>td:first-child,
            .table-responsive>.table-bordered>tbody>tr>td:first-child,
            .table-responsive>.table-bordered>tfoot>tr>td:first-child {
                border-left: 0;
            }

            .table-responsive>.table-bordered>thead>tr>th:last-child,
            .table-responsive>.table-bordered>tbody>tr>th:last-child,
            .table-responsive>.table-bordered>tfoot>tr>th:last-child,
            .table-responsive>.table-bordered>thead>tr>td:last-child,
            .table-responsive>.table-bordered>tbody>tr>td:last-child,
            .table-responsive>.table-bordered>tfoot>tr>td:last-child {
                border-right: 0;
            }

            .table-responsive>.table-bordered>tbody>tr:last-child>th,
            .table-responsive>.table-bordered>tfoot>tr:last-child>th,
            .table-responsive>.table-bordered>tbody>tr:last-child>td,
            .table-responsive>.table-bordered>tfoot>tr:last-child>td {
                border-bottom: 0;
            }
        }

        .clearfix:before,
        .clearfix:after {
            display: table;
            content: " ";
        }

        .clearfix:after {
            clear: both;
        }

        .center-block {
            display: block;
            margin-right: auto;
            margin-left: auto;
        }

        .pull-right {
            float: right !important;
        }

        .pull-left {
            float: left !important;
        }

        .hide {
            display: none !important;
        }

        .show {
            display: block !important;
        }

        .invisible {
            visibility: hidden;
        }

        .text-hide {
            font: 0/0 a;
            color: transparent;
            text-shadow: none;
            background-color: transparent;
            border: 0;
        }

        .hidden {
            display: none !important;
        }

        .affix {
            position: fixed;
        }

        .table-bordered tr {
            text-align: center;
        }

        .no-border tbody,
        .no-border td,
        .no-border tfoot,
        .no-border th,
        .no-border thead,
        .no-border tr {
            border: 0 !important;
        }

        .middle-page {
            position: absolute;
            top: 50%;
        }

        @page {
            odd-header-name: odd-header;
            even-header-name: even-header;
            odd-footer-name: odd-footer;
            even-footer-name: even-footer;

            margin-left: 2.5cm;
            margin-right: 2cm;
        }

    </style>
</head>

<body>
    <htmlpagefooter name="firstpage"></htmlpagefooter>
    <htmlpagefooter name="otherpages">পৃষ্ঠা <span class="bangla-bijoy">{PAGENO}</span></htmlpagefooter>

    <htmlpagefooter name="even-footer">
        <div class="bangla-font" style="float:right; width: 100%; text-align: right;">
            পৃষ্ঠা <span class="bangla-bijoy">{PAGENO}</span>
        </div>
    </htmlpagefooter>

    <htmlpagefooter name="odd-footer">
        <div class="bangla-font" style="float:left; width: 100%; text-align: right;">
            পৃষ্ঠা <span class="bangla-bijoy">{PAGENO}</span>
        </div>
    </htmlpagefooter>

    <div id="writing-screen-wrapper" style="font-family:nikoshpdf,serif !important;">
        <div class="bangla-font" style="font-family:Nikosh,serif !important;text-align: center;color: black">
            {{$directorate_name}} <br>
            অডিট কমপ্লেক্স <br>
            সেগুনবাগিচা, ঢাকা, ১০০০
        </div>
        <br>

        <span>মোট আপত্তি: {{enTobn(count($apotti_list))}}</span> <br>
        <span>
            মোট জড়িত অর্থ (টাকা): {{enTobn(currency_format($total_jorito_ortho_poriman))}}
            ({{ltrim(numberConvertToBnWord($total_jorito_ortho_poriman))}} টাকা মাত্র)
        </span>

        <table style="margin-top: 5px" class="table table-bordered" width="100%">
            <thead class="thead-light">
            {{--<tr>
                <td colspan="8" style="text-align: left">মোট আপত্তিঃ {{enTobn(count($apotti_list['data']))}}</td>
            </tr>--}}
            <tr class="bg-hover-warning">
                @if(in_array('sl_no',$columns))
                    <th style="text-align: center" width="5%">ক্রমিক নং</th>
                @endif

                @if(in_array('id_no',$columns))
                    <th style="text-align: center" width="10%">আইডি</th>
                @endif

                @if(in_array('audit_unit',$columns))
                    <th style="text-align: center" width="20%">অডিট ইউনিট</th>
                @endif

                    @if(in_array('project',$columns))
                        <th style="text-align: center" width="20%">প্রকল্প</th>
                    @endif

                @if(in_array('fiscal_year',$columns))
                    <th style="text-align: center" width="10%">অর্থবছর</th>
                @endif

                @if(in_array('audit_year',$columns))
                    <th style="text-align: center" width="10%">নিরীক্ষা বছর</th>
                @endif

                @if(in_array('onucched_no',$columns))
                    <th style="text-align: center" width="5%">অনুচ্ছেদ নম্বর</th>
                @endif

                @if(in_array('apotti_title',$columns))
                    <th style="text-align: center" width="30%">আপত্তির শিরোনাম</th>
                @endif

                @if(in_array('jorito_ortho',$columns))
                    <th style="text-align: center" width="10%">জড়িত অর্থ (টাকা)</th>
                @endif

                @if(in_array('audit_type',$columns))
                    <th style="text-align: center" width="10%">নিরীক্ষার ধরন</th>
                @endif

                @if(in_array('memo_irregularity_type',$columns))
                    <th style="text-align: center" width="10%">অনিয়মের ধরন</th>
                @endif

                @if(in_array('apotti_current_status',$columns))
                    <th style="text-align: center" width="10%">আপত্তির বর্তমান অবস্থা</th>
                @endif

                @if(in_array('apotti_type',$columns))
                    <th style="text-align: center" width="10%">আপত্তির ধরন</th>
                @endif
            </tr>
            </thead>

            <tbody>
            <tr>
                <th colspan="{{count($columns)}}" style="background: #dfdfdf;padding:8px;text-align: center">
                    <span style="width:30%;display:inline-block;">মন্ত্রণালয়/বিভাগ: {{$ministry_name}}</span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span style="width:30%;display:inline-block;">ডিপার্টমেন্ট/সংস্থা: {{$entity_name}}</span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span style="width:30%;display:inline-block;">গ্রুপ: {{$unit_group_office_name}}</span>
                </th>
            </tr>
            @forelse($apotti_list as $apotti)
                <tr>
                    @if(in_array('sl_no',$columns))
                        <td style="text-align: center">{{enTobn($loop->iteration)}}</td>
                    @endif

                    @if(in_array('id_no',$columns))
                        <td style="text-align: center">{{enTobn($apotti['id'])}}</td>
                    @endif

                    @if(in_array('audit_unit',$columns))
                        <td style="text-align: left;vertical-align: top;">{{$apotti['cost_center_name_bn']}}</td>
                    @endif

                        @if(in_array('project',$columns))
                            <td style="text-align: left;vertical-align: top;">{{$apotti['project_name_bn']}}</td>
                        @endif

                    @if(in_array('fiscal_year',$columns))
                        <td style="text-align: left">{{$apotti['fiscal_year']?enTobn($apotti['fiscal_year']['start']).'-'.enTobn($apotti['fiscal_year']['end']):'---'}}</td>
                    @endif

                    @if(in_array('audit_year',$columns))
                        <td style="text-align: left" width="10%">{{enTobn($apotti['audit_year_start'])}}-{{enTobn($apotti['audit_year_end'])}}</td>
                    @endif

                    @if(in_array('onucched_no',$columns))
                        <td style="text-align: center" width="5%">
                            {{enTobn($apotti['onucched_no'])}}
                        </td>
                    @endif

                    @if(in_array('apotti_title',$columns))
                        <td style="text-align: left;vertical-align: top;" width="20%">
                            {{$apotti['memo_title_bn']}}
                        </td>
                    @endif

                    @if(in_array('jorito_ortho',$columns))
                        <td style="text-align: right" width="10%">
                            {{enTobn(currency_format($apotti['jorito_ortho_poriman']))}}
                        </td>
                    @endif

                    @if(in_array('audit_type',$columns))
                        <td style="text-align: left" width="10%">
                            @if($apotti['audit_type'] == 'compliance')
                                কমপ্লায়েন্স অডিট
                            @endif
                        </td>
                    @endif

                    @if(in_array('memo_irregularity_type',$columns))
                        <td style="text-align: left" width="10%">{{$apotti['memo_irregularity_type_name']}}</td>
                    @endif

                    @if(in_array('apotti_current_status',$columns))
                        <td style="text-align: left" width="5%">{{$apotti['memo_status_name']}}</td>
                    @endif

                    @if(in_array('apotti_type',$columns))
                        <td style="text-align: left" width="10%">
                            @if($apotti['memo_type'] == 'sfi')
                                এসএফআই
                            @elseif($apotti['memo_type'] == 'non-sfi')
                                নন-এসএফআই
                            @endif
                        </td>
                    @endif
                </tr>
            @empty
                <tr data-row="0" class="datatable-row" style="left: 0px;">
                    <td colspan="{{count($columns)}}" class="datatable-cell text-center"><span>Nothing Found</span></td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</body>

</html>
