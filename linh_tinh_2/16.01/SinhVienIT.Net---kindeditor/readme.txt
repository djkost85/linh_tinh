1. Introduction
Kind editor is a powerful yet easy to use, online web-base html editor, which allows users to edit web page in WYSIWYG way. It is compatible with IE, Firefox, Chrome, Safari, Opera and other popular browsers over different platforms.
Written in Javascript, Kind editor could be integrated with any backend technology, such as Java, .NET, PHP, ASP and RoR. Kind editor has been widely used in different CMS(Content Management System), shopping, forum, blog, wiki, email and other web based applications. With excellent user experience, it is becoming one of the most poplular editors.

2. Browsers Supported
FireFox2.0+ IE6+ Opera9+ Safari3+ Chrome

3. Installation & Usage
step 1. Download latest version of KindEditor.
step 2. Unzip it and upload it to one directory of your site. For example, http://yourdomain.com/editor/
step 3. Add a TEXTAREA element to where you would like it to appear.
You must assign an id to it. You'd better set height or width to make sure every kind of browser treat it in the same way.

<textarea id="content_1" name="content" cols="100" rows="8" style="width:700px;height:300px;">textarea>

step 4. Add the following code to head section

<script type="text/javascript" charset="utf-8" src="/editor/kindeditor.js">script>
<script type="text/javascript">
    KE.show({
        id : 'content_1' //ID OF TEXTAREA
    });
script>
Please read documentation for more.

4. Further Guide
To visit us, go to www.kindeditor.com
To get more support or service, or any purchase issue, send email to sales@kindeditor.com


5. About Kindsoft
Kindsoft Technologies LLC is a software company providing cross-browser javascript GUI components and tools & services involved. Our aim is to make AJAX simple and easy. Kindsoft also provides end-to-end solutions in web development (Web 2.0, PHP, ASP.NET, ASP, JSP, XML, Flash), application development and IT consulting services.
