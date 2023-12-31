<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    {{--    <link href="public/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>--}}
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
                content: " (" attr(href) ")";
            }

            abbr[title]:after {
                content: " (" attr(title) ")";
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

            .btn > .caret,
            .dropup > .btn > .caret {
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
            font-size: 12px;
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

        .table > thead > tr > th,
        .table > tbody > tr > th,
        .table > tfoot > tr > th,
        .table > thead > tr > td,
        .table > tbody > tr > td,
        .table > tfoot > tr > td {
            padding: 8px;
            line-height: 1.42857143;
            vertical-align: top;
            border-top: 1px solid #dddddd;
        }

        .table > thead > tr > th {
            vertical-align: bottom;
            border-bottom: 2px solid #dddddd;
        }

        .table > caption + thead > tr:first-child > th,
        .table > colgroup + thead > tr:first-child > th,
        .table > thead:first-child > tr:first-child > th,
        .table > caption + thead > tr:first-child > td,
        .table > colgroup + thead > tr:first-child > td,
        .table > thead:first-child > tr:first-child > td {
            border-top: 0;
        }

        .table > tbody + tbody {
            border-top: 2px solid #dddddd;
        }

        .table .table {
            background-color: #ffffff;
        }

        .table-condensed > thead > tr > th,
        .table-condensed > tbody > tr > th,
        .table-condensed > tfoot > tr > th,
        .table-condensed > thead > tr > td,
        .table-condensed > tbody > tr > td,
        .table-condensed > tfoot > tr > td {
            padding: 5px;
        }

        .table-bordered {
            border: 1px solid #dddddd;
        }

        .table-bordered > thead > tr > th,
        .table-bordered > tbody > tr > th,
        .table-bordered > tfoot > tr > th,
        .table-bordered > thead > tr > td,
        .table-bordered > tbody > tr > td,
        .table-bordered > tfoot > tr > td {
            border: 1px solid #dddddd;
        }

        .table-bordered > thead > tr > th,
        .table-bordered > thead > tr > td {
            border-bottom-width: 2px;
        }

        .table-striped > tbody > tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }

        .table-hover > tbody > tr:hover {
            background-color: #f5f5f5;
        }

        .table > thead > tr > td.active,
        .table > tbody > tr > td.active,
        .table > tfoot > tr > td.active,
        .table > thead > tr > th.active,
        .table > tbody > tr > th.active,
        .table > tfoot > tr > th.active,
        .table > thead > tr.active > td,
        .table > tbody > tr.active > td,
        .table > tfoot > tr.active > td,
        .table > thead > tr.active > th,
        .table > tbody > tr.active > th,
        .table > tfoot > tr.active > th {
            background-color: #f5f5f5;
        }

        .table-hover > tbody > tr > td.active:hover,
        .table-hover > tbody > tr > th.active:hover,
        .table-hover > tbody > tr.active:hover > td,
        .table-hover > tbody > tr:hover > .active,
        .table-hover > tbody > tr.active:hover > th {
            background-color: #e8e8e8;
        }

        .table > thead > tr > td.success,
        .table > tbody > tr > td.success,
        .table > tfoot > tr > td.success,
        .table > thead > tr > th.success,
        .table > tbody > tr > th.success,
        .table > tfoot > tr > th.success,
        .table > thead > tr.success > td,
        .table > tbody > tr.success > td,
        .table > tfoot > tr.success > td,
        .table > thead > tr.success > th,
        .table > tbody > tr.success > th,
        .table > tfoot > tr.success > th {
            background-color: #dff0d8;
        }

        .table-hover > tbody > tr > td.success:hover,
        .table-hover > tbody > tr > th.success:hover,
        .table-hover > tbody > tr.success:hover > td,
        .table-hover > tbody > tr:hover > .success,
        .table-hover > tbody > tr.success:hover > th {
            background-color: #d0e9c6;
        }

        .table > thead > tr > td.info,
        .table > tbody > tr > td.info,
        .table > tfoot > tr > td.info,
        .table > thead > tr > th.info,
        .table > tbody > tr > th.info,
        .table > tfoot > tr > th.info,
        .table > thead > tr.info > td,
        .table > tbody > tr.info > td,
        .table > tfoot > tr.info > td,
        .table > thead > tr.info > th,
        .table > tbody > tr.info > th,
        .table > tfoot > tr.info > th {
            background-color: #d9edf7;
        }

        .table-hover > tbody > tr > td.info:hover,
        .table-hover > tbody > tr > th.info:hover,
        .table-hover > tbody > tr.info:hover > td,
        .table-hover > tbody > tr:hover > .info,
        .table-hover > tbody > tr.info:hover > th {
            background-color: #c4e3f3;
        }

        .table > thead > tr > td.warning,
        .table > tbody > tr > td.warning,
        .table > tfoot > tr > td.warning,
        .table > thead > tr > th.warning,
        .table > tbody > tr > th.warning,
        .table > tfoot > tr > th.warning,
        .table > thead > tr.warning > td,
        .table > tbody > tr.warning > td,
        .table > tfoot > tr.warning > td,
        .table > thead > tr.warning > th,
        .table > tbody > tr.warning > th,
        .table > tfoot > tr.warning > th {
            background-color: #fcf8e3;
        }

        .table-hover > tbody > tr > td.warning:hover,
        .table-hover > tbody > tr > th.warning:hover,
        .table-hover > tbody > tr.warning:hover > td,
        .table-hover > tbody > tr:hover > .warning,
        .table-hover > tbody > tr.warning:hover > th {
            background-color: #faf2cc;
        }

        .table > thead > tr > td.danger,
        .table > tbody > tr > td.danger,
        .table > tfoot > tr > td.danger,
        .table > thead > tr > th.danger,
        .table > tbody > tr > th.danger,
        .table > tfoot > tr > th.danger,
        .table > thead > tr.danger > td,
        .table > tbody > tr.danger > td,
        .table > tfoot > tr.danger > td,
        .table > thead > tr.danger > th,
        .table > tbody > tr.danger > th,
        .table > tfoot > tr.danger > th {
            background-color: #f2dede;
        }

        .table-hover > tbody > tr > td.danger:hover,
        .table-hover > tbody > tr > th.danger:hover,
        .table-hover > tbody > tr.danger:hover > td,
        .table-hover > tbody > tr:hover > .danger,
        .table-hover > tbody > tr.danger:hover > th {
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

            .table-responsive > .table {
                margin-bottom: 0;
            }

            .table-responsive > .table > thead > tr > th,
            .table-responsive > .table > tbody > tr > th,
            .table-responsive > .table > tfoot > tr > th,
            .table-responsive > .table > thead > tr > td,
            .table-responsive > .table > tbody > tr > td,
            .table-responsive > .table > tfoot > tr > td {
                white-space: nowrap;
            }

            .table-responsive > .table-bordered {
                border: 0;
            }

            .table-responsive > .table-bordered > thead > tr > th:first-child,
            .table-responsive > .table-bordered > tbody > tr > th:first-child,
            .table-responsive > .table-bordered > tfoot > tr > th:first-child,
            .table-responsive > .table-bordered > thead > tr > td:first-child,
            .table-responsive > .table-bordered > tbody > tr > td:first-child,
            .table-responsive > .table-bordered > tfoot > tr > td:first-child {
                border-left: 0;
            }

            .table-responsive > .table-bordered > thead > tr > th:last-child,
            .table-responsive > .table-bordered > tbody > tr > th:last-child,
            .table-responsive > .table-bordered > tfoot > tr > th:last-child,
            .table-responsive > .table-bordered > thead > tr > td:last-child,
            .table-responsive > .table-bordered > tbody > tr > td:last-child,
            .table-responsive > .table-bordered > tfoot > tr > td:last-child {
                border-right: 0;
            }

            .table-responsive > .table-bordered > tbody > tr:last-child > th,
            .table-responsive > .table-bordered > tfoot > tr:last-child > th,
            .table-responsive > .table-bordered > tbody > tr:last-child > td,
            .table-responsive > .table-bordered > tfoot > tr:last-child > td {
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

        .no-border tbody, .no-border td, .no-border tfoot, .no-border th, .no-border thead, .no-border tr {
            border: 0 !important;
        }

        .qac_table tr td{
            padding: 10px;
            border-color: black;
        }
    </style>
</head>

<body>
    @if($scope != 'pdf')
        <div class="row mt-5">
            <div class="col-md-6">
                <input id="report_date" type="text" class="form-control date">
            </div>
            <div class="col-md-6">
                <a data-qac-type="{{$qac_type}}"
                   data-air-report-id="{{$air_id}}"
                   onclick="QAC_Apotti_List_Container.qacReportDate($(this))"
                   class="text-right mr-1 btn btn-sm btn-outline-primary btn-square" href="javascript:;">
                    <i class="far fa-save"></i>  সভা সম্পন্ন করুন
                </a>
            </div>
        </div>
        <br>
        <a data-qac-type="{{$qac_type}}"
           data-scope="pdf"
           data-air-report-id="{{$air_id}}"
           onclick="QAC_Apotti_List_Container.exportQacReport($(this))"
           class="text-right mr-1 btn btn-sm btn-outline-primary btn-square" href="javascript:;">
            <i class="far fa-download"></i>  Download
        </a>
    @endif
<div id="writing-screen-wrapper" style="font-family:nikoshpdf,serif !important;">
    <div class="pdf-screen bangla-font" style="height: 100%">
            <div class="bangla-font" style="font-size:18px;text-align: center;color: black">
{{--                মহাপরিচালকের কার্যালয়<br>--}}
                {{$directorateName}} <br>
                {!! $directorateAddress !!}<br>
                <u>{{$directorateWebsite}}</u>
            </div>
            <br>
            <table class="bangla-font" style="width: 100%">
            <tr class="bangla-font">
                <td style="text-align: center">
                    <h3 class="bangla-font" style="text-align: center">
                        @if($qac_type == 'qac-1')
                            কিউএসি-১ সভার কার্যবিবরণী
                        @elseif($qac_type == 'qac-2')
                            কিউএসি-২ সভার কার্যবিবরণী
                        @elseif($qac_type == 'cqat')
                            সিকিউএটি সভার কার্যবিবরণী
                        @endif
                    </h3>
                </td>
            </tr>
        </table>
            <div style="margin-left: 10px" class="row">
                <table class="bangla-font">
                    <tr class="bangla-font">
                        <td class="bangla-font">প্রতিষ্ঠানের নাম :</td>
                        <td class="bangla-font">
                            @php
                                $entities = [];
                                foreach($responseData['rAirInfo']['ap_entities'] as $ap_entities){
                                   $entity =  $ap_entities['entity_name_bn'];
                                    $entities[] = $entity;
                                }
                            @endphp
                            {{implode(' , ', array_unique($entities))}}
                        </td>
                    </tr>
                    <tr class="bangla-font">
                        <td class="bangla-font">নিরীক্ষা বছর :</td>
                        <td class="bangla-font">{{enTobn($responseData['rAirInfo']['fiscal_year']['start'])}}-{{enTobn($responseData['rAirInfo']['fiscal_year']['end'])}}</td>
                    </tr>
                    {{--<tr>
                        <td class="bangla-font">নিরীক্ষার ধরন :</td>
                        <td class="bangla-font"></td>
                    </tr>--}}
                    <tr>
                        <td class="bangla-font">সভার তারিখ :</td>
                        <td class="bangla-font">{{enTobn(formatDate($responseData['rAirInfo']['qac_report_date'],'bn'))}}</td>
                    </tr>
                    <tr>
                        <td valign="top" class="bangla-font">সম্পন্নকারী দল :</td>
                        <td class="bangla-font">
                            @foreach($committeeData['committee']['qac_committee_members'] as $member)
                                    <p>{{enTobn($loop->iteration)}}) {{$member['officer_bn']}}({{$member['officer_designation_bn']}},{{$member['officer_unit_bn']}})</p>
                            @endforeach
                        </td>
                    </tr>
                </table>
            </div>
            <div class="bangla-font" style="height: 100%;margin-top: 10px">
                <div class="bangla-font">
                    <table  class="bangla-font table table-bordered table-striped qac_table" style="width: 100%;margin-top: 10px;padding: 5px"
                            border="1px">
                        <tr class="bangla-font" style="padding: 10px">
                            <td class="bangla-font" style="text-align: center" width="5%">অনুচ্ছেদ নম্বর </td>
                            <td class="bangla-font" style="text-align: center" width="30%"> অনুচ্ছেদের শিরোনাম</td>
                            <td class="bangla-font" style="text-align: center" width="10%"> জড়িত অর্থ (টাকা)</td>
                            @if($qac_type == 'qac-1')
                                <td class="bangla-font" style="text-align: center" width="10%">Audit Criteria ঠিক আছে কিনা ?</td>
                                <td class="bangla-font" style="text-align: center" width="10%">আপত্তিটি 5W 1H মডেল প্যারা অনুসারে করা হয়েছে কিনা ?</td>
                                <td class="bangla-font" style="text-align: center" width="10%">বিধি-বিধান সঠিকভাবে উল্লেখ আছে কিনা ?</td>
                                <td class="bangla-font" style="text-align: center" width="10%">আপত্তির সাথে পরিশিষ্ট মিল আছে কিনা ?</td>
                                <td class="bangla-font" style="text-align: center" width="10%">আপত্তিটি  উপযুক্ত প্রমাণক দ্বারা সমর্থিত কিনা ?</td>
                            @endif
                            @if($qac_type == 'qac-2')
                                <td class="bangla-font" style="text-align: center" width="10%">অডিট Criteria -এর  আলোকে প্রযোজ্য বিধি বিধান Quote করা হয়েছে কিনা ?</td>
                                <td class="bangla-font" style="text-align: center" width="10%">5W 1H এর সকল ধাপ পরিপালন করে আপত্তি গঠন করা হয়েছে কিনা ?</td>
                                <td class="bangla-font" style="text-align: center" width="10%">আপত্তির সমর্থনে উপযুক্ত প্রমাণকের সঠিকতা যাচাই করা হয়েছে কিনা ?</td>
                                <td class="bangla-font" style="text-align: center" width="10%">আপত্তির বিবরণে উল্লিখিত Criteria-এর সাথে অনিয়মের কারণ অংশের মিল আছে কিনা ?</td>
                                <td class="bangla-font" style="text-align: center" width="10%">নিরীক্ষা মন্তব্য অংশে অডিটি প্রতিষ্ঠানের জবাবের আলোকে মন্তব্য প্রদান করা হয়েছে কিনা ?</td>
                            @endif
                            <td class="bangla-font" style="text-align: center" width="10%">
                                {{$qac_type == 'qac-1' ? 'ক্যাটাগরি' : 'কিউএসি ১ এর সিদ্ধান্ত'}}
                            </td>
                            @if($qac_type == 'qac-2' || $qac_type == 'cqat')
                                <td class="bangla-font" style="text-align: center" width="10%">
                                    কিউএসি ২ এর সিদ্ধান্ত
                                </td>
                            @endif
                            <td class="bangla-font" style="text-align: center" width="10%">           মন্তব্য</td>
                        </tr>
{{--                        <tr class="bangla-font">--}}
{{--                            <td class="bangla-font" style="text-align: center" rowspan="5">১।</td>--}}
{{--                            <td class="bangla-font" style="text-align: center" rowspan="5">{{$plan['activity']['title_bn']}}</td>--}}
{{--                        </tr>--}}

                        @php $total_amount = 0; @endphp
                        @foreach($responseData['apottiList'] as $apotti)
                            @foreach($apotti['apotti_map_data']['apotti_status'] as $apotti_status)
                                @if($apotti_status['qac_type'] == $qac_type)
                                <tr class="bangla-font">
                                    <td class="bangla-font" style="text-align: center">
                                        {{enTobn($apotti['apotti_map_data']['onucched_no'])}}
                                    </td>
                                    <td class="bangla-font text-left">
                                        <span>{{$apotti['apotti_map_data']['apotti_title']}}</span>
                                    </td>
                                    <td class="bangla-font" style="text-align: right">
                                        @php
                                            $total_amount += $apotti['apotti_map_data']['total_jorito_ortho_poriman'];
                                        @endphp
                                        <span>{{enTobn(currency_format($apotti['apotti_map_data']['total_jorito_ortho_poriman']))}}/-</span>
                                    </td>
                                    @if($qac_type == 'qac-1')
                                        <td class="bangla-font" style="text-align: center">
                                            {{$apotti_status['is_audit_criteria'] ? 'হ্যাঁ' : 'না'}}
                                        </td>
                                        <td class="bangla-font" style="text-align: center">
                                            {{$apotti_status['is_5w_pera_model'] ? 'হ্যাঁ' : 'না'}}
                                        </td>
                                        <td class="bangla-font" style="text-align: center">
                                            {{$apotti_status['is_rules_and_regulation'] ? 'হ্যাঁ' : 'না'}}
                                        </td>
                                        <td class="bangla-font" style="text-align: center">
                                            {{$apotti_status['is_same_porishisto'] ? 'হ্যাঁ' : 'না'}}
                                        </td>
                                        <td class="bangla-font" style="text-align: center">
                                            {{$apotti_status['is_apotti_evidence'] ? 'হ্যাঁ' : 'না'}}
                                        </td>
                                    @endif

                                    @if($qac_type == 'qac-2')
                                        <td class="bangla-font" style="text-align: center">
                                            {{$apotti_status['is_audit_criteria'] ? 'হ্যাঁ' : 'না'}}
                                        </td>
                                        <td class="bangla-font text-center">
                                            {{$apotti_status['is_5w_pera_model'] ? 'হ্যাঁ' : 'না'}}
                                        </td>
                                        <td class="bangla-font text-center">
                                            {{$apotti_status['is_same_porishisto'] ? 'হ্যাঁ' : 'না'}}
                                        </td>
                                        <td class="bangla-font text-center">
                                            {{$apotti_status['is_criteria_same_as_irregularity'] ? 'হ্যাঁ' : 'না'}}
                                        </td>
                                        <td class="bangla-font text-center">
                                            {{$apotti_status['is_broadsheet_response'] ? 'হ্যাঁ' : 'না'}}
                                        </td>
                                    @endif
                                    <td class="bangla-font" style="text-align: center">
                                        @foreach($apotti['apotti_map_data']['apotti_status'] as $apotti_status)
                                            @if($apotti_status['qac_type'] == 'qac-1')
                                                @if($apotti_status['apotti_type'] == 'draft')
                                                    রিপোর্ট ভুক্তির জন্য প্রস্তাবকৃত এসএফআই
                                                @elseif($apotti_status['apotti_type'] == 'approved')
                                                    রিপোর্ট ভুক্তির জন্য চূড়ান্তকৃত এসএফআই
                                                @elseif($apotti_status['apotti_type'] == 'sfi')
                                                    এসএফআই
                                                @elseif($apotti_status['apotti_type'] == 'non-sfi')
                                                    নন-এসএফআই
                                                @elseif($apotti_status['apotti_type'] == 'reject')
                                                    প্রত্যাহার
                                                @endif
                                            @endif
                                        @endforeach
                                    </td>
                                    @if($qac_type == 'qac-2' || $qac_type == 'cqat')
                                        <td class="bangla-font" style="text-align: center">
                                            @foreach($apotti['apotti_map_data']['apotti_status'] as $apotti_status)
                                                @if($apotti_status['qac_type'] == 'qac-2')
                                                    @if($apotti_status['apotti_type'] == 'draft')
                                                        রিপোর্ট ভুক্তির জন্য প্রস্তাবকৃত এসএফআই
                                                    @elseif($apotti_status['apotti_type'] == 'approved')
                                                        রিপোর্ট ভুক্তির জন্য চূড়ান্তকৃত এসএফআই
                                                    @elseif($apotti_status['apotti_type'] == 'sfi')
                                                        এসএফআই
                                                    @elseif($apotti_status['apotti_type'] == 'non-sfi')
                                                        নন-এসএফআই
                                                    @elseif($apotti_status['apotti_type'] == 'reject')
                                                        প্রত্যাহার
                                                    @endif
                                                @endif
                                            @endforeach
                                        </td>
                                    @endif
                                    <td class="bangla-font" style="text-align: left">
                                        {{$apotti_status['comment']}}
                                    </td>
                                </tr>
                                @endif()
                            @endforeach
                        @endforeach
                        <tr class="bangla-font">
                            <td class="bangla-font" style="text-align: right" colspan="2">সর্বমোট=</td>
                            <td class="bangla-font" style="text-align: right" >{{enTobn(currency_format($total_amount))}}/-</td>
                            <td colspan="7" style="text-align: left">(কথায়: {{numberConvertToBnWord($total_amount)}} টাকা মাত্র)</td>
                        </tr>
                    </table>
                </div>
                <div class="row">
                    <table width="100%" style="margin-top: 20px">
                        <tr>
                            @foreach(array_reverse($committeeData['committee']['qac_committee_members']) as $member)
                                <td class="bangla-font" style="text-align: center" width="30%">
                                    <b>({{$member['officer_bn']}})</b>
                                    <p>{{$member['officer_designation_bn']}}</p>
                                    <p>{{$member['officer_unit_bn']}}</p>
                                </td>
                            @endforeach
                        </tr>
                    </table>
{{--                    @foreach($committeeData['committee']['qac_committee_members'] as $member)--}}
{{--                        <div class="col-md-4 text-center">--}}
{{--                            <b>({{$member['officer_bn']}})</b>--}}
{{--                            <p>{{$member['officer_designation_bn']}}</p>--}}
{{--                            <p>{{$member['officer_unit_bn']}}</p>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
                </div>
            </div>
    </div>
</div>
</body>
</html>


