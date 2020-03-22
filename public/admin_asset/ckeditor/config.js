
CKEDITOR.editorConfig = function( config )
{
        
    config.language = 'en';
    
        
        config.filebrowserBrowseUrl = 'http://localhost/banhang/public/admin_asset/ckeditor/ckfinder/ckfinder.html';

        config.filebrowserImageBrowseUrl = 'http://localhost/banhang/public/admin_asset/ckeditor/ckfinder/ckfinder.html?type=Images';

        config.filebrowserFlashBrowseUrl = 'http://localhost/banhang/public/admin_asset/ckeditor/ckfinder/ckfinder.html?type=Flash';

        config.filebrowserUploadUrl = 'http://localhost/banhang/public/admin_asset/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';

        config.filebrowserImageUploadUrl = 'http://localhost/banhang/public/admin_asset/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';

        config.filebrowserFlashUploadUrl = 'http://localhost/banhang/public/admin_asset/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
        
        config.toolbar_Full = [
            ['Source','-','Save','NewPage','Preview','-','Templates'],
            ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
            ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
            '/',
            ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
            ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],
            ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
            ['BidiLtr', 'BidiRtl' ],
            ['Link','Unlink','Anchor'],
            ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe'],
            '/',
            ['Styles','Format','Font','FontSize'],
            ['TextColor','BGColor'],
            ['Maximize', 'ShowBlocks','-','About']
            ];
        
        //config.entities = false;
        config.entities_latin = false;
        

       

};  