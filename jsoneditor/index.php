<!DOCTYPE HTML>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">

    <title>JSON Editor Online Soartex</title>

    <!--

    @file index.html

    @brief
    JSON Editor Online is a web-based tool to view, edit, and format JSON.
    It shows your data side by side in a clear, editable treeview and in 
    formatted plain text.

    Supported browsers: Chrome, Firefox, Safari, Opera, Internet Explorer 8+

    @license
    This json editor is open sourced with the intention to use the editor as
    a component in your own application. Not to just copy and monetize the editor
    as it is.

    Licensed under the Apache License, Version 2.0 (the "License"); you may not
    use this file except in compliance with the License. You may obtain a copy
    of the License at

    http://www.apache.org/licenses/LICENSE-2.0

    Unless required by applicable law or agreed to in writing, software
    distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
    WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
    License for the specific language governing permissions and limitations under
    the License.

    Copyright (C) 2011-2013 Jos de Jong, http://jsoneditoronline.org

    @author   Jos de Jong, <wjosdejong@gmail.com>
    @date     2013-03-08
    -->
    <link rel="shortcut icon" href="lib/img/favicon.ico">

    <link rel="stylesheet" type="text/css" href="lib/main/app-min.css">
    <link rel="stylesheet" type="text/css" href="lib/jsoneditor/jsoneditor-min.css">

    <script type="text/javascript" src="lib/jsoneditor/jsoneditor-min.js"></script>
    <script type="text/javascript" src="lib/ace/ace-min.js"></script>
    <script type="text/javascript" src="lib/main/app-min.js"></script>
</head>

<body>

<div id="header">
    <a class="header">
        <img alt="JSON Editor Online" title="JSON Editor Online" src="lib/img/logo.png" id="logo">
    </a>

    <div id="menu">
        <ul>
            <li>
                <a id="clear" title="Clear contents">Clear</a>
            </li>
            <li>
                <a id="open" title="Open file from disk">
                    Open
                    <span id="openMenuButton" title="Open file from disk or url">
                    &#x25BC;
                    </span>
                </a>
                <ul id="openMenu">
                    <li>
                        <a id="menuOpenFile" title="Open file from disk">Open&nbsp;file</a>
                    </li>
                    <li>
                        <a id="menuOpenUrl" title="Open file from url">Open&nbsp;url</a>
                    </li>
                </ul>
            </li>
            <li>
                <a id="saveButton" title="Save to a Place">
                    Save
                    <span id="openSaveButton" title="Save to a Place">
                    &#x25BC;
                    </span>
                </a>
                <ul id="openSaveMenu">
                    <li>
                        <a id="save" title="Save file to disk">Save</a>
                    </li>
                    <li>
                        <a id="saveToSite" title="Save file to Site">Save Site</a>
                    </li>
                </ul>
            </li>
            <li>
                <a id="backButton" href="../ZipManager.php" title="Back to Zip Manager">Back</a>
            </li>
        </ul>
    </div>

</div>

<div id="auto">
    <div id="contents">
        <div id="jsonformatter"></div>

        <div id="splitter">
            <div id="buttons">
                <div>
                    <button id="toEditor" class="convert" title="Code to editor">
                        <div class="convert-right"></div>
                    </button>
                </div>
                <div>
                    <button id="toCode" class="convert" title="Editor to code">
                        <div class="convert-left"></div>
                    </button>
                </div>
            </div>
            <div id="drag">
            </div>
        </div>

        <div id="jsoneditor"></div>

        <script type="text/javascript">
            app.load();
            app.resize();
        </script>
    </div>
</div>

<div id="footer">
    <div id="footer-inner">
        <a class="footer">JSON Editor Online 2.1.0</a>
        &bull;
        <a href="https://github.com/josdejong/jsoneditoronline" target="_blank" class="footer">Sourcecode</a>
    </div>
</div>

<script type="text/javascript">
    app.resize();
</script>

<script type="text/javascript" src="lib/jsonlint/jsonlint.js"></script>

</body>
</html>
