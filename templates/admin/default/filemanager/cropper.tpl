<div id="cropper" class="modal-dialog modal-lg">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title">{$title}</h4>
		</div>
		<div class="modal-body">

			
	
            <div class="row">
                <div class="col-md-6">
                    <div class="image-cropper-container content-group" style="height: 400px;">
                        <img src="/uploads/catalog/IMG-20180329-WA00021.jpg" alt="" class="cropper" id="demo-cropper-image">
                    </div>

                    <div class="form-group demo-cropper-toolbar">
                        <label class="text-semibold control-label">Toolbar:</label>
                        <div class="btn-group btn-group-justified">
                            <div class="btn-group">
                                <button type="button" class="btn bg-blue btn-icon" data-method="setDragMode" data-option="move" title="Move">
                                    <span class="icon-move"></span>
                                </button>
                            </div>

                            <div class="btn-group">
                                <button type="button" class="btn bg-blue btn-icon" data-method="setDragMode" data-option="crop" title="Crop">
                                    <span class="icon-crop2"></span>
                                </button>
                            </div>

                            <div class="btn-group">
                                <button type="button" class="btn bg-blue btn-icon" data-method="move" data-option="-10" data-second-option="0" title="Move Left">
                                    <span class="icon-arrow-left13"></span>
                                </button>
                            </div>

                            <div class="btn-group">
                                <button type="button" class="btn bg-blue btn-icon" data-method="move" data-option="10" data-second-option="0" title="Move Right">
                                    <span class="icon-arrow-right14"></span>
                                </button>
                            </div>

                            <div class="btn-group">
                                <button type="button" class="btn bg-blue btn-icon" data-method="move" data-option="0" data-second-option="-10" title="Move Up">
                                    <span class="icon-arrow-up13"></span>
                                </button>
                            </div>

                            <div class="btn-group">
                                <button type="button" class="btn bg-blue btn-icon" data-method="move" data-option="0" data-second-option="10" title="Move Down">
                                    <span class="icon-arrow-down132"></span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group demo-cropper-toolbar">
                        <div class="btn-group btn-group-justified">
                            <div class="btn-group">
                                <button type="button" class="btn bg-blue btn-icon" data-method="zoom" data-option="0.1" title="Zoom In">
                                    <span class="icon-zoomin3"></span>
                                </button>
                            </div>

                            <div class="btn-group">
                                <button type="button" class="btn bg-blue btn-icon" data-method="zoom" data-option="-0.1" title="Zoom Out">
                                    <span class="icon-zoomout3"></span>
                                </button>
                            </div>

                            <div class="btn-group">
                                <button type="button" class="btn bg-blue btn-icon" data-method="rotate" data-option="-45" title="Rotate Left">
                                    <span class="icon-rotate-ccw3"></span>
                                </button>
                            </div>

                            <div class="btn-group">
                                <button type="button" class="btn bg-blue btn-icon" data-method="rotate" data-option="45" title="Rotate Right">
                                    <span class="icon-rotate-cw3"></span>
                                </button>
                            </div>

                            <div class="btn-group">
                                <button type="button" class="btn bg-blue btn-icon" data-method="scaleX" data-option="-1" title="Flip Horizontal">
                                    <span class="icon-flip-vertical4"></span>
                                </button>
                            </div>

                            <div class="btn-group">
                                <button type="button" class="btn bg-blue btn-icon" data-method="scaleY" data-option="-1" title="Flip Vertical">
                                    <span class="icon-flip-vertical3"></span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="text-semibold control-label">Crop:</label>
                        <div class="btn-group btn-group-justified demo-cropper-toolbar">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default" data-method="getCroppedCanvas">
                                    Get Cropped Canvas
                                </button>
                            </div>

                            <div class="btn-group">
                                <button type="button" class="btn btn-default" data-method="getCroppedCanvas" data-option="{ &quot;width&quot;: 150, &quot;height&quot;: 150 }">
                                    150&times;150
                                </button>
                            </div>

                            <div class="btn-group">
                                <button type="button" class="btn btn-default" data-method="getCroppedCanvas" data-option="{ &quot;width&quot;: 120, &quot;height&quot;: 120 }">
                                    120&times;120
                                </button>
                            </div>

                            <div class="btn-group">
                                <button type="button" class="btn btn-default" data-method="getCroppedCanvas" data-option="{ &quot;width&quot;: 90, &quot;height&quot;: 90 }">
                                    90&times;90
                                </button>
                            </div>

                            <div class="btn-group">
                                <button type="button" class="btn btn-default" data-method="getCroppedCanvas" data-option="{ &quot;width&quot;: 60, &quot;height&quot;: 60 }">
                                    60&times;60
                                </button>
                            </div>
                        </div>

                        <!-- Modal with cropped image -->
                        <div class="modal fade docs-cropped" id="getCroppedCanvasModal" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h6 class="modal-title" id="getCroppedCanvasTitle">Cropped</h6>
                                    </div>
                                    <div class="modal-body text-center"></div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <a href="#" class="btn btn-primary" id="download" download="cropped.jpg">Download</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /modal with cropped image -->

                    </div>

                    <div class="form-group">
                        <label class="text-semibold control-label">Aspect ratio:</label>
                        <div class="btn-group btn-group-justified demo-cropper-ratio" data-toggle="buttons">
                            <label class="btn btn-default">
                                <input type="radio" class="sr-only" id="aspectRatio0" name="aspectRatio" value="1.7777777777777777">
                                16:9
                            </label>
                            <label class="btn btn-default">
                                <input type="radio" class="sr-only" id="aspectRatio1" name="aspectRatio" value="1.3333333333333333">
                                4:3
                            </label>
                            <label class="btn btn-default">
                                <input type="radio" class="sr-only" id="aspectRatio2" name="aspectRatio" value="1">
                                1:1
                            </label>
                            <label class="btn btn-default">
                                <input type="radio" class="sr-only" id="aspectRatio3" name="aspectRatio" value="0.6666666666666666">
                                2:3
                            </label>
                            <label class="btn btn-default">
                                <input type="radio" class="sr-only" id="aspectRatio4" name="aspectRatio" value="NaN">
                                Free
                            </label>
                        </div>
                    </div>

                    <div class="form-group no-margin-bottom">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="checkbox checkbox-switchery switchery-double switchery-xs text-center">
                                    <label>
                                        Clear
                                        <input type="checkbox" class="clear-crop-switch" checked="checked">
                                        Crop
                                    </label>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="checkbox checkbox-switchery switchery-double switchery-xs text-center">
                                    <label>
                                        Disable
                                        <input type="checkbox" class="enable-disable-switch" checked="checked">
                                        Enable
                                    </label>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="checkbox checkbox-switchery switchery-double switchery-xs text-center">
                                    <label>
                                        Destroy
                                        <input type="checkbox" class="destroy-create-switch" checked="checked">
                                        Create
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="content-group text-center">
                        <div class="eg-preview">
                            <div class="preview preview-lg"></div>
                            <div class="preview preview-md"></div>
                            <div class="preview preview-sm"></div>
                            <div class="preview preview-xs"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="text-semibold control-label">X value:</label>
                                <input type="text" class="form-control" id="dataX" placeholder="x">
                            </div>

                            <div class="form-group">
                                <label class="text-semibold control-label">Width:</label>
                                <input type="text" class="form-control" id="dataWidth" placeholder="width">
                            </div>

                            <div class="form-group">
                                <label class="text-semibold control-label">ScaleX:</label>
                                <input type="text" class="form-control" id="dataScaleX" placeholder="scaleX">
                            </div>
                        </div>


                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="text-semibold control-label">Y value:</label>
                                <input type="text" class="form-control" id="dataY" placeholder="y">
                            </div>

                            <div class="form-group">
                                <label class="text-semibold control-label">Height:</label>
                                <input type="text" class="form-control" id="dataHeight" placeholder="height">
                            </div>

                            <div class="form-group">
                                <label class="text-semibold control-label">ScaleY:</label>
                                <input type="text" class="form-control" id="dataScaleY" placeholder="scaleY">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="text-semibold control-label">General data:</label>
                        <div class="input-group">
                            <input class="form-control" id="showData1" type="text" placeholder="General data">
                            <span class="input-group-btn">
                                <button class="btn btn-default" id="getData" type="button">Get Data</button>
                                <button class="btn btn-default" id="setData" type="button">Set Data</button>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="text-semibold control-label">Container &amp; image data:</label>
                        <div class="input-group">
                            <input class="form-control" id="showData2" type="text" placeholder="Container and image data">
                            <span class="input-group-btn">
                                <button class="btn btn-default" id="getContainerData" type="button">Get Container Data</button>
                                <button class="btn btn-default" id="getImageData" type="button">Get Image Data</button>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="text-semibold control-label">Canvas data:</label>
                        <div class="input-group">
                            <input class="form-control" id="showData3" type="text" placeholder="Canvas data">
                            <span class="input-group-btn">
                                <button class="btn btn-default" id="getCanvasData" type="button">Get Canvas Data</button>
                                <button class="btn btn-default" id="setCanvasData" type="button">Set Canvas Data</button>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="text-semibold control-label">Crop box data:</label>
                        <div class="input-group">
                            <input class="form-control" id="showData4" type="text" placeholder="Crop box data">
                            <span class="input-group-btn">
                                <button class="btn btn-default" id="getCropBoxData" type="button">Get Crop Box Data</button>
                                <button class="btn btn-default" id="setCropBoxData" type="button">Set Crop Box Data</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
				
		</div>
	</div>
</div>