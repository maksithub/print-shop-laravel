@extends('layouts.front.app')

<style type="text/css">
  input[type=file]{
    display: none;
  }
  #image_preview{
    padding: 10px;
  }
  #image_preview img{
    width: 200px;
    padding: 5px;
    margin: auto;
  }
  .upload_panel{
    border:1px solid #ddd;
  }
  .panel_heading{
    background: #ddd;
    padding: 10px 30px;
    font-size: 17px;
    font-weight: bold;
  }
  .panel_body{
    padding: 25px;
  }
  .submit_wrapper{
    padding: 20px;
  }
  .submit_wrapper input{width:100%;}
  .tab-content .tab-pane{
    padding: 5em;
    border-radius: 1em;
    border: 1px solid #ddd;
  }
  .woocommerce-tabs ul{
    text-align: center;
  }
  @media screen and (max-width: 767px){
    .woocommerce-tabs ul{
      display: flex;
      justify-content: space-between;
    }
  }
  .alert-success{
    display: none;
    border-left-color: #138d16;
    border-left: 2px;
  }
  .progress-bar{
    height: 15px;
    background: #00abc5;
    width:0%;
    -webkit-transition: width 1s;
    transition: width 1s;
  }
  .percent{
    display: none;
  }
  #progressDivId{height: inherit;}
  .wrong-file-link{display: none;}
  .wrong-file-link a{
    cursor: default;
  }
</style>

@section('js')
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
  <script type="text/javascript">
    $("#uploadFile").change(function(){
       $('#image_preview').html("");
       var total_file=document.getElementById("uploadFile").files.length;
       for(var i=0;i<total_file;i++)
       {
        if (event.target.files[i].type.includes("image")) {
           $('#image_preview').append("<img src='"+URL.createObjectURL(event.target.files[i])+"'>");
         }else{
            $('#image_preview').append("<img src='{{ asset('images/document-icon-28.png') }}'>");
         }
       }
    });
    $('form.upload_form').ajaxForm({
      // target: '.panel_body .alert-success',
      dataType:'json',
      beforeSend: function() {
        $("#progressBar").width('0%');
      },
      uploadProgress: function(event, position, total, percentComplete) {
        var percentValue = percentComplete + '%';
        $("#progressBar").width(percentValue);
        $(".percent").html(percentValue);
      },
      complete: function(xhr) {
        var returnedData = JSON.parse(xhr.responseText);
          $("#progressBar").hide();
          $('.panel_body .alert-success').fadeIn('slow');
          $("input.art_image").val(returnedData["image_link"]);
          $("input.continue").prop('disabled', false);
          $(".formgroup").hide();
          $(".wrong-file-link").show();
      },
      error: function(error){
        alert("File Upload Fialed!");
      }
    });
    $(".wrong-file-link").click(function(){
      $(".formgroup").show();
      $(".alert-success").hide();
      $("#progressBar").width('0%');
      $(this).hide();
    });
  </script>

@endsection

@section('content')
<div id="content" class="site-content no-aside" tabindex="-1">
	<div class="container">
		<nav class="woocommerce-breadcrumb"><a href="index.php">Home</a><span class="delimiter"><i class="fa fa-angle-right"></i></span>Upload</nav>
		<hr>
		<div class="row page_title">
			<div class="uplaod-top col-md-12">
				<h2>Upload File</h2>
				<p>{{$product->name}}</p>
			</div>
		</div>
		<hr>
		<div id="primary" class="content-area">
			<main id="main" class="site-main">				
				<div class="row">
					<div class="col-md-8 col-sm-12 col-xs-12">
            <div class="upload_panel">
              <div class="panel_heading">Artworks</div>

              <div class="panel_body">

                <div class='progress' id="progressDivId">
                    <div class='progress-bar' id='progressBar'></div>
                    <div class='percent' id='percent'>0%</div>
                </div>
                <div class="alert alert-success">
                  <strong> File successfully received!</strong><br> Your file has been successfully received by our system and is being processed now.
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <form action="{{ route('images.upload') }}" method="post" enctype="multipart/form-data" class="upload_form">
                        {{ csrf_field() }}
                        <div class="formgroup">
                          <label for="uploadFile">
                            <span class="btn"><i class="fa fa-upload" aria-hidden="true"></i>Upload file from Computer</span>
                          </label>
                          <input type="file" id="uploadFile" name="uploadFile[]"/>
                          <input type="submit" class="btn btn-success" name='submitImage' value="Upload Image"/>
                        </div>
                        <div class="wrong-file-link">
                          <br>Wrong file?
                          <a>Upload a new file</a>
                        </div>
                    </form>
                  </div>

                  <div class="col-md-6">
                    <h4>Image Preview</h4>
                    <div id="image_preview"></div>
                  </div>
                </div>
              </div>
              </div><!-- upload_panel -->
            </div><!-- col-md-8 -->
            <div class="col-md-4 col-sm-12 col-xs-12">
              <form class="variations_form cart" action = "{{ route('cart.store') }}" method="post">
                {{ csrf_field() }}
              <div class="upload_panel hidden-md-down">
                <div class="panel_heading">Select the proofing option</div>
                <div class="panel_body">
                  <div class="row">
                    <div class="col-md-12"><p>Every print-ready file gets a 30 point automated and human review to ensure technical quality. Please choose one of the following:</p></div>
                    <div class="col-md-1">
                      <input type="radio" name="proofing_options" value="proof_request" id="proof_request" checked="checked">
                    </div>
                    <div class="col-md-10">
                      <label for="proof_request">Print ASAP</label>
                      <p>If your file passes review, we will print it ASAP. If we find a problem we can't fix, we'll contact you.</p>
                    </div>

                    <div class="col-md-1">
                      <input type="radio" name="proofing_options" value="proof_request" id="proof_request2">
                    </div>
                    <div class="col-md-10">
                      <label for="proof_request2">Wait - I want to receive and approve a free PDF proof.</label>
                      <p>We will email you a link to a PDF proof within 6 hours. Don't worry, we won't print your file until you check the PDF and approve it online. Be aware this could delay your order by a day or more.</p>
                    </div>
                  </div>
                </div>
              </div><!-- UPload Panel -->
              <div class="submit_wrapper">
                <input type="submit" name="submit" value="Continue" class="continue" disabled>
                <input type="hidden" name="product" value="1"/>
                <input type="hidden" name="product" value="{{ $product->id }}" />
                <input type="hidden" name="productName" value="{{ $product->name }}" />
                <input type="hidden" name="add-to-cart" value="{{ $product->id }}" />
                <input type="hidden" name="product_id" value="{{ $product->id }}" />
                <input type="hidden" name="variation_id" class="variation_id" value="0" />
                <input type="hidden" name="quantity" class="variation_id" value="1" />
                <input type="hidden" name="art_upload" class="art_image" value="">
                <input type="hidden" name="final_price" value="{{$final_price}}">
              </div>
            </form>
            </div><!-- col-md-4 -->
					</div><!-- #row -->
          <div style="height: 4em;display: block;"></div>
          <div class="row">
            <div class="woocommerce-tabs wc-tabs-wrapper">
              <ul class="nav nav-tabs electro-nav-tabs tabs wc-tabs" role="tablist">
                <li class="nav-item filespecs_tab">
                  <a href="#tab-filespecs" class="active" data-toggle="tab" aria-expanded="false">File specification</a>
                </li>
                <li class="nav-item proofing_tab">
                  <a href="#tab-proofing" data-toggle="tab" class="" aria-expanded="false">Proofing</a>
                </li>

                <li class="nav-item learningcenter_tab">
                  <a href="#tab-learningcenter" data-toggle="tab" class="" aria-expanded="false">Learning center</a>
                </li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane panel entry-content wc-tab active" id="tab-filespecs">
                  <div id="filespecs" class="row">
                    <div class="col-sm-12">
                        <dl>
                            <dt>What are the recommended file formats?</dt>
                            <dd>PDF is ideal for printing, but we also accept JPG, JPEG, PNG, TIF, TIFF, EPS, Illustrator, Publisher, DOCX, DOC files.</dd>

                            <dt>What is the maximum allowed file size to upload?</dt>
                            <dd>200 MB. If your file is larger than 200 MB, please contact <a href="/contact-us.html" target="_blank"> Customer Service </a> for assistance.</dd>

                            <dt>What are the artwork requirements?</dt>
                            <dd>We require artworks to be in CMYK color space and have a minimum resolution of 300dpi. A 0.125" bleed from each side of artwork is required for most products. We will convert files submitted in RGB color space to CMYK before printing and minor color shifts may occur.</dd>

                            <dt>Are there File Setup Templates available for download?</dt>
                            <dd>Yes. Please visit our <a href="/print-templates/" target="_blank">File Setup Templates </a> page to download templates for your preffered design software.</dd>
                        </dl>
                    </div>
                  </div>
                </div><!-- tab-pane -->
                <div class="tab-pane panel entry-content wc-tab" id="tab-proofing">
                  <div id="proofing" class="row">
                    <div class="col-sm-12">
                      <dl>
                          <dt>What is a PDF proof?</dt>
                          <dd>A PDF proof is a document we prepare upon your request, so you can check details like trim lines, folding lines and colors before we begin printing your order.</dd>

                          <dt>How long does it take for PDF proofs to get ready?</dt>
                          <dd>If you request for a PDF proof, it will be ready within 6 hours after you place your order. You will receive an email notification once your proof is ready. You will need to go to <a href="https://www.uprinting.com/jobs.html">Your Account</a> to review and approve your proof so we can continue processing your order.</dd>
                          <dd><b>Note:</b> On rare occasions, we find issues in your files that require further input from you. In such cases, our experts will contact you within 24 business hours to work with you on a resolution.</dd>

                          <dt>Will requesting a PDF proof delay my order?</dt>
                          <dd>Possibly. Proofs approved before 6PM PST will go into the printing queue that day. Proofs approved after 6PM PST will go into the printing queue the following day.</dd>

                          <dt>What if I find a problem in my PDF proof?</dt>
                          <dd>If you notice any issues in your PDF proof, you can reject it and request a new one with additonal comments or instructions, or you can submit a new file. You can always contact <a href="/contact-us.html" target="_blank"> Customer Service </a> if you need further assistance with your files.</dd>

                          <dt>Do you correct possible spelling errors in my artwork?</dt>
                          <dd>No. We do not change text or art. We only fix print-related technical issues found in your file.<br></dd>
                      </dl>
                    </div>
                  </div>
                </div><!-- tab-pane -->
                <div class="tab-pane panel entry-content wc-tab" id="tab-learningcenter">
                  <div id="learningcenter" class="row">
                    <div class="col-sm-12">
                      <dl>
                          <dt>What is bleed?</dt>
                          <dd>A bleed is when an image extends beyond the trim edge of the product. If your image is not white on all four sides, you will want to include bleeds in your files. Add 1/8" (.125") to each side of the file. For example, for a 2" x 3.5" business card with full bleed, the image size should be submitted at 2.25" x 3.75".</dd>

                          <dt>What is safe zone?</dt>
                          <dd>Safe area is the 1/8" margin that we require between the trim line and the text closest to the trim line.</dd>

                          <dt>What is CMYK?</dt>
                          <dd>CMYK stands for Cyan, Magenta, Yellow, and Key (Black). This is the industry standard process colors used in full-color offset printing. The combination of these four colors can produce a wide spectrum of colors. Cyan, Magenta, and Yellow combine to create the color, while Black is used to change the shade of the color.</dd>
                      </dl>                
                    </div>
                  </div>
                </div><!-- tab-pane -->
              </div><!-- tab-content -->
            </div><!-- woocommerce-tabs -->
          </div><!-- #row -->
			</main><!-- #main -->
		</div><!-- #primary -->
	</div><!-- .container -->
</div><!-- #content -->
@endsection