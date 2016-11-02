<!--<script type="text/javascript" src="<?php // echo DEFAULT_ADMIN_JS_PATH . "pages/datatables_data_sources.js";                                              ?>"></script>-->
<script type="text/javascript" src="<?php echo DEFAULT_ADMIN_JS_PATH . "plugins/tables/datatables/datatables.min.js"; ?>"></script>
<script type="text/javascript" src="<?php echo DEFAULT_ADMIN_JS_PATH . "plugins/forms/selects/select2.min.js"; ?>"></script>
<!-- Page header -->
<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Admin</span> - Banner List</h4>
        </div>
    </div>

    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo base_url() . "admin/dashboard" ?>"><i class="icon-home2 position-left"></i> Admin</a></li>
            <li><i class="icon-file-picture position-left"></i> Banners</li>
        </ul>
    </div>
</div>
<!-- /page header -->

<?php
if ($this->session->flashdata('success')) {
    ?>
    <div class="content pt0 flashmsg">
        <div class="alert alert-success">
            <a class="close" data-dismiss="alert">X</a>
            <strong><?= $this->session->flashdata('success') ?></strong>
        </div>
    </div>
    <?php
    $this->session->set_flashdata('success', false);
} else if ($this->session->flashdata('error')) {
    ?>
    <div class="content pt0 flashmsg">
        <div class="alert alert-danger">
            <a class="close" data-dismiss="alert">X</a>
            <strong><?= $this->session->flashdata('error') ?></strong>
        </div>
    </div>
    <?php
    $this->session->set_flashdata('error', false);
} else {
    if (!empty(validation_errors())) {
        ?>
        <div class="content pt0 flashmsg">
            <div class = "alert alert-danger">
                <a class="close" data-dismiss="alert">X</a>
                <strong><?php echo validation_errors(); ?></strong>       
            </div>
        </div>
        <?php
    }
}
?>
<!-- Content area -->
<div class="content">
    <!-- /content area -->
    <div class="content">
        <div class="panel panel-flat">
            <div class="panel-heading text-right">
                <a href="<?php echo site_url('admin/banners/add'); ?>" class="btn btn-success btn-labeled"><b><i class="icon-add"></i></b> Add new banner</a>
            </div>
            <div class="content">
                <?php
                if (isset($banners) && !empty($banners)) {
                    foreach ($banners as $banner) {
                        ?>
                        <div class="row">
                            <div class="col-lg-12 col-sm-12">
                                <div class="thumbnail banners-thumbnail-wrapper">
                                    <div class="thumb">
                                        <img src="<?php echo DEFAULT_BANNER_IMAGE_PATH . $banner['image']; ?>" alt="<?php echo $banner['image_name']; ?>">
                                    </div>

                                    <div class="caption">
                                        <h6 class="no-margin">
                                            <a href="#" class="text-default">Page : <?php echo $banner['page']; ?></a> 
                                            <div class="banner-options">
                                                <span class="banner-option" title="Edit"><a href="<?php echo base_url() . 'admin/banners/edit/' . $banner['id']; ?>" class="text-muted btn border-primary text-primary-600 btn-flat btn-icon btn-rounded btn-sm"><i class="icon-pencil3 "></i></a></span>
                                                <?php
                                                if ($banner['is_active'] == 1) {
                                                    ?>
                                                    <span class="banner-option" title="Deactive"><a href="<?php echo base_url() . 'admin/banners/block/' . $banner['id']; ?>" class="text-muted btn border-danger text-danger-600 btn-flat btn-icon btn-rounded"><i class="icon-cross2 pull-right"></i></a></span>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <span class="banner-option" title="Active"><a href="<?php echo base_url() . 'admin/banners/activate/' . $banner['id']; ?>" class="text-muted btn border-success text-success-600 btn-flat btn-icon btn-rounded"><i class="icon-check pull-right"></i></a></span>
                                                            <?php
                                                        }
                                                        ?>
                                            </div>
                                        </h6>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
<script>
//    $(function () {
//        $('.datatable-basic').dataTable({
//            processing: true,
//            serverSide: true,
//            language: {
//                search: '<span>Filter:</span> _INPUT_',
//                lengthMenu: '<span>Show:</span> _MENU_',
//                paginate: {'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;'}
//            },
//            dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
//            order: [[0, "asc"]],
//            ajax: 'banners/list_banners',
//            columns: [
//                {
//                    data: "test_id",
//                    visible: true,
//                    searchable: false,
//                    sortable: false,
//                },
//                {
//                    data: "page",
//                    visible: true
//                },
//                {
//                    data: "image",
//                    visible: true,
//                    "render": function (data, type, full, meta) {
//                        return '<img src="<?php echo DEFAULT_BANNER_IMAGE_PATH; ?>' + full.image + '" style="max-width:100%">';
//                    }
//                },
//                {
//                    data: "is_active",
//                    visible: true,
//                    searchable: false,
//                    sortable: false,
//                    width: 200,
//                    render: function (data, type, full, meta) {
//                        var action = '';
//                        if (full.is_active == '1') {
//                            action += '<a href="<?php echo base_url(); ?>admin/banners/edit/' + full.id + '" class="btn border-primary text-primary-600 btn-flat btn-icon btn-rounded btn-sm" title="Edit"><i class="icon-pencil3"></i></a>';
//                            action += '&nbsp;&nbsp;<a href="<?php echo base_url(); ?>admin/banners/delete/' + full.id + '" class="btn border-danger text-danger-600 btn-flat btn-icon btn-rounded" title="Deactive"><i class="icon-cross2"></i></a>';
//                        }
//                        return action;
//                    }
//                }
//            ]
//        });
//
//        $('.dataTables_length select').select2({
//            minimumResultsForSearch: Infinity,
//            width: 'auto'
//        });
//    });
</script>