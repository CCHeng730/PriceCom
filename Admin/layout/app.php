<!DOCTYPE html>
<html>
    <head>
        <base href="../">
        <meta charset="utf-8" />
        <title>PriceCom | Admin</title>
        <link href="assets/app.css" rel="stylesheet" type="text/css" />
        <link href="assets/admin/plugins/global/plugins.bundle.css" rel="stylesheet"/>
        <link href="assets/admin/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet"/>
        <link href="assets/admin/css/style.bundle.css" rel="stylesheet"/>
        <link href="assets/admin/css/themes/layout/header/base/light.css" rel="stylesheet"/>
        <link href="assets/admin/css/themes/layout/header/menu/light.css" rel="stylesheet"/>
        <link href="assets/admin/css/themes/layout/brand/dark.css" rel="stylesheet"/>
        <link href="assets/admin/css/themes/layout/aside/dark.css" rel="stylesheet"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    </head>
    <body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
        <div id="app">   
            <main class="pt-4">
                <?php include "../layout/header.php" ?>
                <?php include "../layout/sidepanel.php" ?>
            </main>
        </div>
    </body>
    <!--begin::Global Config(global config for global JS scripts)-->
    <script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
    <!--end::Global Config-->
    <!--begin::Global Theme Bundle(used by all pages)-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="assets/admin/plugins/global/plugins.bundle.js"></script>
    <script src="assets/admin/plugins/custom/prismjs/prismjs.bundle.js"></script>
    <script src="assets/admin/js/scripts.bundle.js"></script>
    <script type="text/javascript" src="assets/admin/plugins/custom/datatables/datatables.bundle.js" defer></script>
    <script type="text/javascript" src="assets/admin/js/pages/crud/datatables/basic/scrollable.js" defer></script>
</html>