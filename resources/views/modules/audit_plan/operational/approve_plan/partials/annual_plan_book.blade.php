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
        }

        td,
        th {
            padding: 0;
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

            h2,
            h3 {
                page-break-after: avoid;
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
                border: 1px solid #ddd !important;
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
            font-size: 10px;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        }

        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 14px;
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
            border: 1px solid #dddddd;
        }

        .table-bordered>thead>tr>th,
        .table-bordered>tbody>tr>th,
        .table-bordered>tfoot>tr>th,
        .table-bordered>thead>tr>td,
        .table-bordered>tbody>tr>td,
        .table-bordered>tfoot>tr>td {
            border: 1px solid #dddddd;
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
    </style>
</head>

<body>
    <button data-office-id="{{$office_id}}" data-fiscal-year-id="{{$fiscal_year_id}}"
            data-annual-plan-main-id="{{$annual_plan_main_id}}"
            data-activity-type="{{$activity_type}}"
            onclick="Annual_Plan_Container.printAnnualPlan($(this))"
            class="btn btn-sm btn-primary btn-square">
        <i class="fad fa-file-download"></i>
        ডাউনলোড
    </button>

    <div id="writing-screen-wrapper" style="font-family:nikoshpdf,serif !important;">
        <div class="pdf-screen bangla-font" style="height: 100%">
            <div class="bangla-font" style="text-align: center;font-size: 12px;margin-top: 5px">
                {{-- {{ $plan_infos['office_info']['office_name_bn'] }} <br>
                {!! $directorate_address !!} --}}
                <x-office-header-details officeid="{{$office_id}}" />
            </div>
            <div class="bangla-font" style="text-align: center;font-size: 15px;margin-top: 5px">
                <span>
                    <u>বার্ষিক অডিট পরিকল্পনা</u>
                </span>
                <br>
                <span style="margin-top: 5px">
                    অর্থ-বছরঃ{{ enTobn($plan_infos['fiscal_year']['start']) }}-{{ enTobn($plan_infos['fiscal_year']['end']) }}
                </span>
            </div>

            <div style="text-align: center;font-size: 15px;margin-top: 5px">
                {{-- সেক্টর-০২ঃ --}}
                @foreach (array_unique(array_column($plan_infos['all_ministries'], 'ministry_name_bn')) as $ministry)
                    {{ enTobn($loop->iteration) }} | {{ $ministry }}
                @endforeach
            </div>
            {{-- pdf screen 02 --}}
            @foreach ($plan_infos['plans'] as $plan)
                <div class="bangla-font" style="height: 100%;margin-top: 10px">
                    <div class="bangla-font">
                        <table class="bangla-font table table-bordered table-striped"
                            style="width: 100%;margin-top: 10px;padding: 5px" border="1px">
                            <tr class="bangla-font">
                                <td class="bangla-font" style="text-align: center" width="5%">ক্রম</td>
                                <td class="bangla-font" style="text-align: center" width="20%">কার্যক্রম</td>
                                <td class="bangla-font" style="text-align: center" width="60%">কমপ্লায়েন্স অডিটের
                                    বিভিন্ন পর্যায়</td>
                                <td class="bangla-font" style="text-align: center" width="15%">নির্ধারিত সময়সীমা</td>
                            </tr>
                            <tr class="bangla-font">
                                <td class="bangla-font" style="text-align: center" rowspan="5">১।</td>
                                <td class="bangla-font" style="text-align: center" rowspan="5">
                                    {{ $plan['activity']['title_bn'] }}</td>
                            </tr>
                            @foreach ($plan['activity']['milestones'] as $milestone)
                                <tr class="bangla-font">
                                    <td class="bangla-font pl-2">{{ $milestone['title_bn'] }}</td>
                                    <td class="bangla-font" style="text-align: center">
                                        {{ enTobn($milestone['milestone_calendar']['target_date']) }}</td>
                                </tr>
                            @endforeach
                            {{-- <tr class="bangla-font">
                            <td class="bangla-font">নিরীক্ষা পরিদর্শন প্রতিবেদন (এআইআর) এর সংখ্যা</td>
                            <td class="bangla-font" style="text-align: center">{{enTobn(count($plan['annual_plans']))}} ({{numberConvertToBnWord(count($plan['annual_plans']))}}) টি</td>
                        </tr> --}}
                        </table>
                    </div>
                    {{-- <div class="bangla-font" style="text-align: center;font-size: 12px;margin-top: 5px"> --}}
                    {{-- {{$plan_infos['office_info']['office_name_bn']}} <br> --}}
                    {{-- অডিট কমপ্লেক্স (৮ম ও ৯ম তলা) <br> --}}
                    {{-- সেগুন বাগিচা, ঢাকা-১০০০। --}}
                    {{-- </div> --}}

                    {{-- <div class="bangla-font" style="text-align: center;font-size: 15px;margin-top: 5px"> --}}
                    {{-- বার্ষিক অডিট পরিকল্পনা --}}{{-- (সেক্টর-০২) --}}{{-- - অর্থ-বছরঃ{{enTobn($plan_infos['fiscal_year']['start'])}} --}}
                    {{-- -{{enTobn($plan_infos['fiscal_year']['end'])}}ঃ --}}
                    {{-- {{enTobn($loop->iteration)}} | {{$plan['ministries']['ministry_name_bn']}} --}}
                    {{-- </div> --}}

                    <div class="bangla-font">
                        @if ($plan['activity']['activity_type'] == 'compliance')
                            <table class="bangla-font table table-bordered table-striped"
                                style="width: 100%;margin-top: 10px" border="1px">
                                <tr class="bangla-font" style="padding: 5px">
                                    <td class="bangla-font" style="text-align: center" width="3%">ক্রঃনং</td>
                                    <td class="bangla-font" style="text-align: center" width="10%">মন্ত্রণালয়/ বিভাগ
                                    </td>
                                    <td class="bangla-font" style="text-align: center" width="10%">এনটিটি/প্রতিষ্ঠানের নাম
                                    </td>

                                    @if($office_id == 18)
                                        <td class="bangla-font" style="text-align: center" width="10%">
                                            প্রজেক্ট
                                        </td>
                                    @endif

                                    <td class="bangla-font" style="text-align: center" width="10%">এনটিটি/প্রতিষ্ঠানের ধরন
                                    </td>
                                    <td class="bangla-font" style="text-align: center" width="10%">এনটিটি/প্রতিষ্ঠানের মোট
                                        ইউনিট সংখ্যা
                                    </td>
                                    <td class="bangla-font" style="text-align: center" width="20%">অডিটের জন্য
                                        প্রস্তাবিত
                                        ইউনিটের
                                        নাম ও সংখ্যা
                                    </td>
                                    <td class="bangla-font" style="text-align: center" width="10%">সাবজেক্ট ম্যাটার
                                    </td>
                                    <td class="bangla-font" style="text-align: center" width="15%">প্রয়োজনীয় লোকবল
                                    </td>
                                    <td class="bangla-font" style="text-align: center" width="12%">মন্তব্য</td>
                                </tr>
                                <tr class="bangla-font" style="padding: 5px">
                                    <td class="bangla-font" style="text-align: center" width="3%">০১</td>
                                    <td class="bangla-font" style="text-align: center" width="10%">০২</td>
                                    <td class="bangla-font" style="text-align: center" width="10%">০৩</td>
                                    @if($office_id == 18)
                                        <td class="bangla-font" style="text-align: center" width="10%">০৪</td>
                                    @endif
                                    <td class="bangla-font" style="text-align: center" width="10%"> {{$office_id == 18 ? '০৫' : '০৪'}} </td>
                                    <td class="bangla-font" style="text-align: center" width="10%">{{$office_id == 18 ?  '০৬' : '০৫' }}</td>
                                    <td class="bangla-font" style="text-align: center" width="20%"> {{$office_id == 18 ? '০৭' : '০৬' }} </td>
                                    <td class="bangla-font" style="text-align: center" width="10%">{{$office_id == 18 ?  '০৮' : '০৭' }}</td>
                                    <td class="bangla-font" style="text-align: center" width="15%">{{$office_id == 18 ?  '০৯' : '০৮' }}</td>
                                    <td class="bangla-font" style="text-align: center" width="12%">{{$office_id == 18 ?  '১০' : '০৯' }} </td>
                                </tr>
                                @foreach ($plan['annual_plans'] as $id => $annual_plans)
                                    <tr class="bangla-font" style="padding: 5px">
                                        <td class="bangla-font" style="text-align: center" width="3%">
                                            {{ enTobn($loop->iteration) }}</td>
                                        <td class="bangla-font" width="10%">
                                            @php
                                                $ministries = [];
                                                foreach ($annual_plans['ap_entities'] as $ap_entities) {
                                                    $ministry = $ap_entities['ministry_name_bn'];
                                                    $ministries[] = $ministry;
                                                }
                                            @endphp
                                            {{ implode(' , ', array_unique($ministries)) }}
                                        </td>
                                        <td class="bangla-font" style="text-align: center" width="10%">
                                            @php
                                                $entities = [];
                                                foreach ($annual_plans['ap_entities'] as $ap_entities) {
                                                    $entity = $ap_entities['entity_name_bn'];
                                                    $entities[] = $entity;
                                                }
                                            @endphp
                                            {{ implode(' , ', array_unique($entities)) }}
                                        </td>

                                        @if($office_id == 18)
                                            <td class="bangla-font" width="10%">
                                                {{ $annual_plans['project_name_bn'] }}
                                            </td>
                                        @endif
                                        <td class="bangla-font" width="10%">{{ $annual_plans['office_type'] }}
                                        </td>
                                        <td class="bangla-font" style="text-align: center" width="10%">
                                            {{ enTobn($annual_plans['total_unit_no']) }}</td>
                                        <td class="bangla-font" width="20%">
                                            @foreach ($annual_plans['ap_entities'] as $ap_entities)
                                                {{ $ap_entities['entity_name_bn'] }} (এনটিটি) <br>
                                                @foreach (json_decode($ap_entities['nominated_offices'], true) as $office)
                                                    {{ enTobn($loop->iteration) }}| {{ $office['office_name_bn'] }}
                                                    <br>
                                                @endforeach
                                                <br>
                                            @endforeach
                                            <span style="float: right!important;font-weight: bold">মোট
                                                {{ enTobn($annual_plans['nominated_office_counts']) }}টি ইউনিট</span>
                                        </td>
                                        <td class="bangla-font" style="text-align: center" width="10%">
                                            {{ $annual_plans['subject_matter'] }}</td>
                                        <td class="bangla-font" width="15%">
                                            @if (isset(json_decode($annual_plans['nominated_man_powers'], true)['staffs']) &&
                                                count(json_decode($annual_plans['nominated_man_powers'], true)['staffs']) > 0)
                                                @foreach (json_decode($annual_plans['nominated_man_powers'], true)['staffs'] as $man)
                                                    {{ enTobn($loop->iteration) }}|
                                                    {{ $man['designation_bn'] . ', ' . $man['responsibility_bn'] . ' - ' . enTobn($man['staff']) . 'জন' }}
                                                    <br>
                                                @endforeach
                                                <br>
                                            @endif

                                            @if (isset(json_decode($annual_plans['nominated_man_powers'], true)['comment']))
                                                {{ json_decode($annual_plans['nominated_man_powers'], true)['comment'] }}
                                            @endif


                                        </td>
                                        <td class="bangla-font" width="12%">{{ $annual_plans['comment'] }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            <table class="bangla-font table table-bordered table-striped"
                                style="width: 100%;margin-top: 10px" border="1px">
                                <tr class="bangla-font" style="padding: 5px">
                                    <td class="bangla-font" style="text-align: center" width="3%">ক্রঃনং</td>
                                    <td class="bangla-font" style="text-align: center" width="10%">পারফরম্যান্স
                                        নিরীক্ষার বিষয়</td>
                                    <td class="bangla-font" style="text-align: center" width="12%">মন্তব্য</td>
                                </tr>
                                @foreach ($plan['annual_plans'] as $id => $annual_plans)
                                    <tr class="bangla-font" style="padding: 5px">
                                        <td class="bangla-font" style="text-align: center" width="3%">
                                            {{ enTobn($loop->iteration) }}</td>
                                        <td class="bangla-font" width="10%">
                                            {{ $annual_plans['subject_matter'] }},
                                            @php
                                                $ministries = [];
                                                foreach ($annual_plans['ap_entities'] as $ap_entities) {
                                                    $ministry = $ap_entities['ministry_name_bn'];
                                                    $ministries[] = $ministry;
                                                }
                                            @endphp
                                            @php
                                                $entities = [];
                                                foreach ($annual_plans['ap_entities'] as $ap_entities) {
                                                    $entity = $ap_entities['entity_name_bn'];
                                                    $entities[] = $entity;
                                                }
                                            @endphp
                                            {{ implode(' , ', array_unique($entities)) }},
                                            {{ implode(' , ', array_unique($ministries)) }}
                                        </td>
                                        <td class="bangla-font" width="12%">{{ $annual_plans['comment'] }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>

</html>
