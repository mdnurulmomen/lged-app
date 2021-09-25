<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <style>
        html {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        @font-face {
            font-family: 'SolaimanLipi';
            src: url({{asset('assets/font/SolaimanLipi.ttf')}}) format('truetype');
            font-weight: normal;
            font-style: normal
        }

        body {
            margin: 0;
            font-family: SolaimanLipi !important;
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

        .pdf-screen {
            background-color: #ffffff;
            padding: 0.25in;
            height: 842px;
            width: 595px;
            margin: 0 auto;
            position: relative;
        }

        .pdf-screen:last-child {
            margin-bottom: 0;
        }

        .pdf-screen .no-border th, #split-2 .pdf-screen .no-border td {
            border: 0 !important;
            padding-left: 0;
        }

        .pdf-screen .no-border {
            border: 0 !important;
        }

        .pdf-screen .pageTileNumber {
            position: absolute;
            top: 12px;
            left: 0;
            width: 100%;
            text-align: center;
        }

        @media print {
            @page {
                size: A4;
                margin: .25in;
            }
        }
    </style>
</head>
<body style="margin-top: 15px" onLoad="window.print();" onclick="window.close();">
<div id="writing-screen-wrapper" style="font-family:SolaimanLipi,serif !important;">
    <div class="pdf-screen" style="height: 100%;font-family:SolaimanLipi,serif !important; page-break-after:always">
        <div style="font-family:SolaimanLipi,serif !important;text-align: center">
            গণপ্রজাতন্ত্রী বাংলাদেশ সরকার <br>
            <b>বাণিজ্যিক অডিট অধিদপ্তর</b> <br>
            অডিট কমপ্লেক্স (৮ম ও ৯ম তলা) <br>
            সেগুনবাগিচা, ঢাকা -১০০০।
        </div>

        <div style="font-family:SolaimanLipi,serif !important;width: 100%;margin-top: 10px">
            <span style="width: 70%;float: left">
                নং- ৪৬৬/Operational Plan/২০২১-২২/
            </span>
            <span style="width: 30%;float: right">
                তারিখঃ  &nbsp;&nbsp;/০৯/২০২১ খ্রি।
            </span>
        </div>

        <div style="font-family:SolaimanLipi,serif !important;text-align: center">
           <b><u>অফিস আদেশ</u></b>
        </div>
        <div style="font-family:SolaimanLipi,serif !important;text-align: justify">
            বাণিজ্যিক অডিট অধিদপ্তরের অফিস আদেশ নং- ৪৬৬/Operational Plan/২০২১-২২/; তারিখঃ   /০৯/২০২১ খ্রি এর মাধ্যমে বাংলাদেশ ব্যাংক এর
            ২০১৯-২০২০ এবং ২০২০-২০২১ অর্থবছরের সার্বিক কার্যক্রম নিরীক্ষার নিমিত্ত নিরীক্ষা দল গঠন করা হয়েছে। নিম্নবর্ণিত নিরীক্ষা দলের নিরীক্ষা কর্মসূচি আদিষ্ট হয়ে অনুমোদন করা হলো।
        </div>

        <div style="font-family:SolaimanLipi,serif !important;text-align: center">
            <b><u>নিরীক্ষা দল নং-০১</u></b>
        </div>

        <div style="margin-top: 5px">
            <table width="100%" border="1">
                <thead>
                <tr>
                    <th style="text-align: center" width="5%">ক্রমিক নং</th>
                    <th style="text-align: center" width="45%">নাম</th>
                    <th style="text-align: center" width="20%">পদবী</th>
                    <th style="text-align: center" width="15%">নিরীক্ষা দলের অবস্থান</th>
                    <th style="text-align: center" width="15%">মোবাইল নং</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td style="text-align: center">১</td>
                    <td style="text-align: left">জনাব নিতাই কুমার বিশ্বাস</td>
                    <td style="text-align: center">উপপরিচালক</td>
                    <td style="text-align: center">দলনেতা</td>
                    <td style="text-align: center">০১৭১৬৬৩৬৬১৫</td>
                </tr>
                <tr>
                    <td style="text-align: center">২</td>
                    <td style="text-align: left">জনাব সৈয়দ শাখাওয়াত হোসেন</td>
                    <td style="text-align: center">নিরীক্ষা ও হিসাবরক্ষণ কর্মকর্তা</td>
                    <td style="text-align: center">উপ দলনেতা</td>
                    <td style="text-align: center">০১৭১৬৬৩৬৬১৫</td>
                </tr>
                <tr>
                    <td style="text-align: center">৩</td>
                    <td style="text-align: left">জনাব জুয়েল রানা</td>
                    <td style="text-align: center">এসএএস সুপার</td>
                    <td style="text-align: center">সদস্য</td>
                    <td style="text-align: center">০১৭১৬৬৩৬৬১৫</td>
                </tr>
                </tbody>
            </table>
        </div>

        <div style="font-family:SolaimanLipi,serif !important;text-align: center;margin-top: 10px">
            <b><u>উপ দল নং-০১ (ক)</u></b>
        </div>

        <div style="margin-top: 5px">
            <table width="100%" border="1">
                <thead>
                <tr>
                    <th style="text-align: center" width="5%">ক্রমিক নং</th>
                    <th style="text-align: center" width="45%">নাম</th>
                    <th style="text-align: center" width="20%">পদবী</th>
                    <th style="text-align: center" width="15%">মোবাইল নং</th>
                    <th style="text-align: center" width="15%">মন্তব্য</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td style="text-align: center">১</td>
                    <td style="text-align: left">জনাব সৈয়দ শাখাওয়াত হোসেন</td>
                    <td style="text-align: center">নিরীক্ষা ও হিসাবরক্ষণ কর্মকর্তা</td>
                    <td style="text-align: center">০১৭১৬৬৩৬৬১৫</td>
                    <td style="text-align: center"></td>
                </tr>
                <tr>
                    <td style="text-align: center">২</td>
                    <td style="text-align: left">জনাব জুয়েল রানা</td>
                    <td style="text-align: center">এসএএস সুপার</td>
                    <td style="text-align: center">০১৭১৬৬৩৬৬১৫</td>
                    <td style="text-align: center"></td>
                </tr>
                </tbody>
            </table>
        </div>

        <div style="margin-top: 15px">
            <table width="100%" border="1">
                <tbody>
                <tr>
                    <td style="text-align: center" width="5%">ক্রমিক নং</td>
                    <td style="text-align: center" width="45%">শাখার নাম</td>
                    <td style="text-align: center" width="20%">নিরীক্ষা বছর</td>
                    <td style="text-align: center" width="15%">নিরীক্ষা সময়কাল</td>
                    <td style="text-align: center" width="15%">মোট কর্ম দিবস</td>
                </tr>
                <tr>
                    <td style="text-align: center" width="5%">১</td>
                    <td style="text-align: center" width="45%">২</td>
                    <td style="text-align: center" width="20%">৩</td>
                    <td style="text-align: center" width="15%">৪</td>
                    <td style="text-align: center" width="15%">৫</td>
                </tr>
                <tr>
                    <td style="text-align: center">১.</td>
                    <td style="text-align: left">বাংলাদেশ ব্যাংক, প্রধান কার্যালয়, ঢাকা</td>
                    <td style="text-align: center">২০১৯-২০ ও ২০২০-২১</td>
                    <td style="text-align: center">০৯/০৯/২০২১ খ্রি. হতে ০৯/০৯/২০২১ খ্রি.</td>
                    <td style="text-align: center">০১ কর্ম দিবস</td>
                </tr>
                <tr>
                    <td style="text-align: center">২.</td>
                    <td colspan="3" style="text-align: center">১১/০৯/২০২১ খ্রি ঢাকা থেকে চট্টগ্রামের উদ্দেশ্যে যাত্রা</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: right">সর্বমোট</td>
                    <td style="text-align: center">০১ কর্ম দিবস</td>
                </tr>
                </tbody>
            </table>
        </div>

        <div style="margin-top: 5px">
            <table width="100%" border="1">
                <thead>
                <tr>
                    <th style="text-align: center" width="5%">ক্রমিক নং</th>
                    <th style="text-align: center" width="45%">নাম</th>
                    <th style="text-align: center" width="20%">পদবী</th>
                    <th style="text-align: center" width="15%">মোবাইল নং</th>
                    <th style="text-align: center" width="15%">মন্তব্য</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td style="text-align: center">১</td>
                    <td style="text-align: left">জনাব সৈয়দ শাখাওয়াত হোসেন</td>
                    <td style="text-align: center">নিরীক্ষা ও হিসাবরক্ষণ কর্মকর্তা</td>
                    <td style="text-align: center">০১৭১৬৬৩৬৬১৫</td>
                    <td style="text-align: center"></td>
                </tr>
                <tr>
                    <td style="text-align: center">২</td>
                    <td style="text-align: left">জনাব জুয়েল রানা</td>
                    <td style="text-align: center">এসএএস সুপার</td>
                    <td style="text-align: center">০১৭১৬৬৩৬৬১৫</td>
                    <td style="text-align: center"></td>
                </tr>
                </tbody>
            </table>
        </div>

        {{--for audit advice--}}
        <div style="font-family:SolaimanLipi,serif !important;margin-top: 10px">
            <u>নিরীক্ষা দলের প্রতি নির্দেশনা:</u>
        </div>

        <div style="font-family:SolaimanLipi,serif !important;text-align: justify">
            ১. জনাব নিতাই কুমার বিশ্বাস, উপপরিচালক দলনেতা হিসেবে সামগ্রিক অডিট কার্যক্রম সম্পন্ন করবেন। <br>
            ২. মাঠ পর্যায়ের নিরীক্ষা কার্যক্রম শেষ হওয়ার পরবর্তী ০৭(সাত) কর্মদিবসের মধ্যে মহাপরিচালক বরাবর AIR দাখিল করতে হবে।
        </div>

        <div style="font-family:SolaimanLipi,serif !important;text-align: center;float: right">
            (নাসিমুল ইসলাম) <br>
            পরিচালক <br>
            ফোন: ৪৮৩২১১৫৯
        </div>
    </div>
    <div class="pdf-screen" style="height: 100%;font-family:SolaimanLipi,serif !important; page-break-after:always">
        <div style="font-family:SolaimanLipi,serif !important;width: 100%;margin-top: 10px">
            <span style="width: 70%;float: left">
                নং- ৪৬৬/Operational Plan/২০২১-২২/
            </span>
            <span style="width: 30%;float: right">
                তারিখঃ  &nbsp;&nbsp;/০৯/২০২১ খ্রি।
            </span>
        </div>

        {{--for audit advice--}}
        <div style="font-family:SolaimanLipi,serif !important;margin-top: 10px">
            <u>সদয় অবগতি ও প্রয়োজনীয় ব্যবস্থা গ্রহণের জন্য অনুলিপি প্রেরণ করা হলো :(জ্যেষ্ঠতার ক্রমানুসারে নয় )</u>
        </div>

        <div style="font-family:SolaimanLipi,serif !important;text-align: justify">
            ১. বাংলাদেশের কম্পট্রোলার এন্ড অডিটর জেনারেল ,অডিট ভবন ,৭৭/৭,কাকরাইল ,ঢাকা-১০০০। <br>
            ২. সচিব ,আর্থিক প্রতিষ্ঠান বিভাগ, ভবন নং-৭, বাংলাদেশ সচিবালয়, ঢাকা ১০০০।
        </div>

        <div style="font-family:SolaimanLipi,serif !important;text-align: center;float: right">
            (নাহিদ আক্তার) <br>
            নিরীক্ষা ও হিসাবরক্ষণ কর্মকর্তা <br>
            প্রশাসন-৩ শাখা <br>
            ফোন: ৪৮৩২১১৫৯
        </div>
    </div>
</div>
</body>
</html>

