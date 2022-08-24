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
            font-size: 10px;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        }

        body {
            font-family: Poppins, Nikosh, sans-serif;
            font-size: 16px;
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

        @page {
            odd-header-name: odd-header;
            even-header-name: even-header;
            odd-footer-name: odd-footer;
            even-footer-name: even-footer;
        }
    </style>
</head>

<body>
<div id="writing-screen-wrapper" style="font-family:nikoshpdf,serif !important;">
    {{--cover page--}}
    <div class="pdf-screen bangla-font" style="height: 100%;page-break-after: always;">
        {!! $plans[0]['content'] !!}
    </div>

    {{--index page--}}
    <div class="pdf-screen bangla-font" style="height: 100%;page-break-after: always;">
        {!! $plans[1]['content'] !!}
    </div>

    {{--strategic form part 01--}}
    <div class="pdf-screen bangla-font" style="height: 100%;page-break-after: always;">
        {!! $plans[3]['content'] !!}
    </div>

    {{--strategic form part 02--}}
    <div class="pdf-screen bangla-font" style="height: 100%;page-break-after: always;">
        {!! $plans[4]['content'] !!}
    </div>

    {{--strategic form part 03--}}
    <div class="pdf-screen bangla-font" style="height: 100%;page-break-after: always;">
        {!! $plans[5]['content'] !!}
    </div>

    {{--audit plan form 1 (part-01)--}}
    <div class="pdf-screen bangla-font" style="height: 100%;page-break-after: always;">
        {!! $plans[6]['content'] !!}
        {!! $plans[7]['content'] !!}
        {!! $plans[8]['content'] !!}
        {!! $plans[9]['content'] !!}
        {!! $plans[10]['content'] !!}
    </div>

    {{--audit plan form 1 (part-02)--}}
    <div class="pdf-screen bangla-font" style="height: 100%;page-break-after: always;">
        <table style='margin-bottom: 5px; width: 100%;' border='0' width='100%' cellspacing='0' cellpadding='0'>
            <tbody>
            <tr>
                <td style='width: 6%; vertical-align: top;'>১.৪</td>
                <td style='vertical-align: top; width: 94%;' colspan='2'>
                    জ্যেষ্ঠতার ক্রমানুসারে অডিট দলের সদস্যগণের নাম (দলনেতা ক্রমিক ১ এ)
                </td>
            </tr>
            </tbody>
        </table>

        @if(!empty($team_members))
            <div style='margin-bottom: 10px;'>
                <table width="100%" border="1">
                    <thead>
                    <tr>
                        <th style="text-align: center" width="6%">ক্রমিক নং</th>
                        <th style="text-align: center" width="49%">নাম</th>
                        <th style="text-align: center" width="45%">সংশোধিত</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($team_members as $member)
                        <tr>
                            <td style="text-align: center">{{enTobn($loop->iteration)}}</td>
                            <td style="text-align: left">জনাব {{$member['team_member_name_bn']}},{{$member['team_member_designation_bn']}}</td>
                            <td style="text-align: left"></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        {{--{!! $plans[11]['content'] !!}--}}
    </div>

    {{--audit plan form 1 (part-03)--}}
    <div class="pdf-screen bangla-font" style="height: 100%;page-break-after: always;">
        {!! $plans[12]['content'] !!}
        {!! $plans[13]['content'] !!}
    </div>

    {{--audit plan form 2 (part-01)--}}
    <div class="pdf-screen bangla-font" style="height: 100%;page-break-after: always;">
        {!! $plans[14]['content'] !!}
        {!! $plans[15]['content'] !!}
    </div>

    {{--audit plan form 2 (part-01)--}}
    <div class="pdf-screen bangla-font" style="height: 100%;page-break-after: always;">
        {!! $plans[16]['content'] !!}
        {!! $plans[17]['content'] !!}
    </div>

    {{--audit plan form 2 (part-02)--}}
    <div class="pdf-screen bangla-font" style="height: 100%;page-break-after: always;">
        {!! $plans[18]['content'] !!}
        {!! $plans[19]['content'] !!}
        {!! $plans[20]['content'] !!}
    </div>

    {{--audit plan form 2 (part-02)--}}
    <div class="pdf-screen bangla-font" style="height: 100%;page-break-after: always;">
        {!! $plans[21]['content'] !!}
        {!! $plans[22]['content'] !!}
    </div>

    {{--audit plan form 2 (part-03)--}}
    <div class="pdf-screen bangla-font" style="height: 100%;page-break-after: always;">
        {!! $plans[23]['content'] !!}
    </div>

    {{--audit plan form 2 (part-04)--}}
    <div class="pdf-screen bangla-font" style="height: 100%;page-break-after: always;">
        {!! $plans[24]['content'] !!}
    </div>

    {{--audit plan form 2 (part-05)--}}
    <div class="pdf-screen bangla-font" style="height: 100%;page-break-after: always;">
        {!! $plans[25]['content'] !!}
    </div>

    {{--audit plan form 2 (part-06)--}}
    <div class="pdf-screen bangla-font" style="height: 100%;page-break-after: always;">
        {!! $plans[26]['content'] !!}
    </div>

    {{--audit risk assessment page--}}
    <div class="pdf-screen bangla-font" style="height: 100%;page-break-after: always;">
        {!! $plans[27]['content'] !!}
    </div>

    {{--materiality calculate page--}}
    <div class="pdf-screen bangla-font" style="height: 100%;page-break-after: always;">
        <p><strong>ঝুঁকি বিশ্লেষণ ও ম্যাটেরিয়ালিটি:</strong></p>
        @if(!empty($risk_assessments))
            @php $inherent_risk = $risk_assessments['inherent_risk']; @endphp
            @php $control_risk = $risk_assessments['control_risk']; @endphp
            @php $detection_risk = $risk_assessments['detection_risk']; @endphp

            @if(!empty($inherent_risk))

                <h4>Inherent Risk</h4>
                <table class="table" border="1" width="100%">
                    <thead>
                    <tr>
                        <th width="10%" style="text-align: center">ক্রমিক নং</th>
                        <th width="70%" style="text-align: left">
                            ইনহেরেন্ট রিস্ক ফ্যাক্টর
                        </th>
                        <th width="20%" style="text-align: left">
                            রিস্কস্কোর (উচ্চ/মধ্যম/নিম্ন)
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $total_number = 0; @endphp
                    @foreach($inherent_risk['risk_assessment_items'] as $risk_assessment_item)
                        @php
                            $risk_value = $risk_assessment_item['risk_value'] ?? 0;
                            $total_number += $risk_value;
                        @endphp
                        <tr>
                            <td style="text-align: center">{{enTobn($loop->iteration)}}</td>
                            <td>{{$risk_assessment_item['risk_assessment_title_bn']}}</td>
                            <td style="text-align: center">{{enTobn($risk_value)}}</td>
                        </tr>
                    @endforeach

                    <tr>
                        <td style="text-align: center" colspan="2">মোট:</td>
                        <td style="text-align: center">{{enTobn($total_number)}}</td>
                    </tr>
                    <tr>
                        <td style="text-align: center" colspan="2">
                            সামগ্রিক ইনহেরেন্ট রিস্ক
                        </td>
                        <td style="text-align: center">
                            {{enTobn(round($inherent_risk['risk_rate'],2))}}
                        </td>
                    </tr>
                    </tbody>
                </table>
            @endif

            @if(!empty($control_risk))
                <h4>Control Risk</h4>
                <table class="table" border="1" width="100%">
                    <thead>
                    <tr>
                        <th width="10%" style="text-align: center">ক্রমিক নং</th>
                        <th width="70%" style="text-align: left">
                            কন্ট্রোল রিস্ক ফ্যাক্টর
                        </th>
                        <th width="20%" style="text-align: left">
                            রিস্কস্কোর (উচ্চ/মধ্যম/নিম্ন)
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $total_number = 0; @endphp
                    @foreach($control_risk['risk_assessment_items'] as $risk_assessment_item)
                        @php
                            $risk_value = $risk_assessment_item['risk_value'] ?? 0;
                            $total_number += $risk_value;
                        @endphp
                        <tr>
                            <td style="text-align: center">{{enTobn($loop->iteration)}}</td>
                            <td>{{$risk_assessment_item['risk_assessment_title_bn']}}</td>
                            <td style="text-align: center">{{enTobn($risk_value)}}</td>
                        </tr>
                    @endforeach

                    <tr>
                        <td style="text-align: center" colspan="2">মোট:</td>
                        <td style="text-align: center">{{enTobn($total_number)}}</td>
                    </tr>
                    <tr>
                        <td style="text-align: center" colspan="2">
                            সামগ্রিক ইনহেরেন্ট রিস্ক
                        </td>
                        <td style="text-align: center">
                            {{enTobn(round($control_risk['risk_rate'],2))}}
                        </td>
                    </tr>
                    </tbody>
                </table>
            @endif

            @if(!empty($detection_risk))
                <h4>Detection Risk</h4>
                <table class="table" border="1" width="100%">
                    <thead>
                    <tr>
                        <th width="10%" style="text-align: center">ক্রমিক নং</th>
                        <th width="45%" style="text-align: left">ডিটেকশান রিস্ক</th>
                        <th width="45%" style="text-align: left">মিটিগেশন</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($detection_risk['risk_assessment_items'] as $risk_assessment_item)
                        <tr>
                            <td style="text-align: center">{{enTobn($loop->iteration)}}</td>
                            <td>{{$risk_assessment_item['risk_assessment_title_bn']}}</td>
                            <td>
                                {{$risk_assessment_item['detection_risk_value_bn']}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        @endif
    </div>

    {{--audit schedule page--}}
    <div class="pdf-screen bangla-font" style="height: 100%;page-break-after: always">
        {{--{!! $plans[30]['content'] !!}--}}
        <p><strong>নিরীক্ষা সূচী:</strong></p>
        <div style="text-align: center">
            @php
                $allWorkingDates = [];
            @endphp
            @if($team_schedules)
                @foreach($team_schedules as $audit_team_schedule)
                    @if($audit_team_schedule['team_schedules'] != null)
                        <div style="margin-top: 15px">
                            <table width="100%" border="1">
                                <tbody>
                                <tr>
                                    <td colspan="7" style="text-align: center">{{$audit_team_schedule['team_name']}}</td>
                                </tr>
                                <tr>
                                    <td style="text-align: center" width="5%">ক্রমিক নং</td>
                                    <td style="text-align: center" width="30%">নিরীক্ষা প্রতিষ্ঠানের নাম</td>
                                    <td style="text-align: center" width="15%">নিরীক্ষার বৎসর (অর্থ বছর)</td>
                                    <td style="text-align: center" width="15%">নিরীক্ষার শুরুর তারিখ</td>
                                    <td style="text-align: center" width="15%">নিরীক্ষার শেষের তারিখ</td>
                                    <td style="text-align: center" width="15%">কর্ম দিবস</td>
                                    <td style="text-align: center" width="15%">মন্তব্য</td>
                                </tr>
                                @php
                                    $schedule_sl = 0;
                                @endphp
                                @foreach(json_decode($audit_team_schedule['team_schedules'],true) as $role => $team_schedule)
                                    @if($team_schedule['schedule_type'] == 'schedule')
                                        @php
                                            $schedule_sl++;
                                            $activity_man_days = empty($team_schedule['activity_man_days'])?0:$team_schedule['activity_man_days'];
                                            $teamWiseWorkingDates = getWorkingDates(date('Y-m-d', strtotime('-1 day', strtotime($team_schedule['team_member_start_date']))),$activity_man_days,$vacations);
                                        @endphp

                                        @if(!empty($teamWiseWorkingDates))
                                            @foreach($teamWiseWorkingDates as $teamWiseWorkingDate)
                                                @php $allWorkingDates[] = $teamWiseWorkingDate; @endphp
                                            @endforeach
                                        @endif

                                        <tr>
                                            <td style="text-align: center">{{enTobn($schedule_sl)}}.</td>
                                            <td style="text-align: left;margin-left: 5px">{{$team_schedule['cost_center_name_bn']}}</td>
                                            <td style="text-align: center">{{enTobn($audit_team_schedule['audit_year_start'])}}-{{enTobn($audit_team_schedule['audit_year_end'])}}</td>
                                            <td style="text-align: center">
                                                {{formatDate($team_schedule['team_member_start_date'],'bn')}} খ্রি.
                                            </td>
                                            <td style="text-align: center">
                                                {{formatDate($team_schedule['team_member_end_date'],'bn')}} খ্রি.
                                            </td>
                                            <td style="text-align: center">
                                                @if($activity_man_days > 0)
                                                    {{enTobn($activity_man_days)}} কর্ম দিবস
                                                @endif
                                            </td>
                                            <td></td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="7" style="text-align: center">{{formatDate($team_schedule['team_member_start_date'],'bn')}} খ্রি. {{$team_schedule['activity_details']}}</td>
                                        </tr>
                                    @endif
                                @endforeach
                                @php
                                    $allWorkingDates = !empty($allWorkingDates) ?  array_unique($allWorkingDates) : [];
                                @endphp
                                <tr>
                                    <th colspan="5" style="text-align: right">সর্বমোট</th>
                                    <th style="text-align: center">
                                        @if(count($allWorkingDates) > 0)
                                            {{enTobn(count($allWorkingDates))}} কর্ম দিবস
                                        @endif
                                    </th>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    @endif

                    @php unset($allWorkingDates); @endphp
                @endforeach
            @endif
        </div>
    </div>

    {{--audit other details page--}}
    @if(array_key_exists(31, $plans))
        <div class="pdf-screen bangla-font" style="height: 100%">
            {!! $plans[31]['content'] !!}
        </div>
    @endif

    <htmlpagefooter name="even-footer">
        <div style="float:right; width: 100%; text-align: right;">Page <span class="page_number">{PAGENO}</span> of {nb}</div>
    </htmlpagefooter>

    <htmlpagefooter name="odd-footer">
        {{--@php $pageNumber = ; @endphp--}}
        <div style="float:left; width: 100%; text-align: right;">Page {PAGENO} of {nb}</div>
    </htmlpagefooter>
</div>
</body>
</html>
