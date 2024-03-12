<form id="main-form" class="vg-wrap vg-element vg-ninteen-of-twenty" method="post" action="<?=$this->adminPath . $this->action?>" enctype="multipart/form-data">
    <div class="vg-wrap vg-element vg-full">
        <div class="vg-wrap vg-element vg-full vg-firm-background-color4 vg-box-shadow">
            <div class="vg-element vg-half vg-left">
                <div class="vg-element vg-padding-in-px">
                    <input type="submit" class="vg-text vg-firm-color1 vg-firm-background-color4 vg-input vg-button" value="Сохранить">
                </div>
				<?php if(empty($this->noDelete) && !empty($this->data)):?>
	                <div class="vg-element vg-padding-in-px">
	                    <a href="/admin/delete/goods/53" class="vg-text vg-firm-color1 vg-firm-background-color4 vg-input vg-button vg-center vg_delete">
	                        <span>Удалить</span>
	                    </a>
	                </div>
	            <?php endif;?>
            </div>
        </div>
    </div>

    <?php if (!empty($this->data)):?>
        <input id="tableId" type="hidden" name="<?=$this->columns['id_row']?>" value="<?=$this->data[$this->columns['id_row']]?>">
    <?php endif;?>

    <input type="hidden" name="table" value="<?=$this->table?>">

	<?php
		foreach($this->templateBlocks as $class => $block){
			
			if(is_int($class)) $class = 'left-block';
		
			echo '<div class="vg-wrap vg-element ' . $class . '">';
			
			if($class !== 'content_block') echo '<div class="vg-full vg-firm-background-color4 vg-box-shadow">';
			
			if(!empty($block)){
				
				foreach($block as $row){
				
					if(!empty($this->templateArr)){
						
						foreach($this->templateArr as $template => $items){
						
							if(in_array($row, $items)){
							
								if(!@include $_SERVER['DOCUMENT_ROOT'] . $this->formTemplates . $template . '.php'){
									throw new \core\base\exceptions\RouteException('Не найден шаблон ' .
		                                               $_SERVER['DOCUMENT_ROOT'] . $this->formTemplates . $template . '.php');
								}
								
								break;
							
							}
						
						}
						
					}
				
				}
				
			}
			
			if($class !== 'content_block') echo '</div>';
			echo '</div>';
		
		}
	?>
    <!--<div class="vg-wrap vg-element left-block">
        <div class="vg-full vg-firm-background-color4 vg-box-shadow">
            <div class="vg-element vg-full vg-box-shadow">
                <div class="vg-wrap vg-element vg-full vg-box-shadow">
                    <div class="vg-wrap vg-element vg-full">
                        <div class="vg-element vg-full vg-left">
                            <span class="vg-header">Ссылка ЧПУ</span>
                        </div>
                        <div class="vg-element vg-full vg-left">
                            <span class="vg-text vg-firm-color5"></span><span class="vg_subheader"></span>
                        </div>
                    </div>
                    <div class="vg-element vg-full">
                        <div class="vg-element vg-full vg-left ">
                            <input type="text" name="alias" class="vg-input vg-text vg-firm-color1" value="test-53">
                        </div>
                    </div>
                </div>
            </div>
            <div class="vg-element vg-full vg-box-shadow img_wrapper">
                <div class="vg-wrap vg-element vg-full">
                    <div class="vg-wrap vg-element vg-full">
                        <div class="vg-element vg-full vg-left">
                            <span class="vg-header">new_gallery_img</span>
                        </div>
                        <div class="vg-element vg-full vg-left">
                            <span class="vg-text vg-firm-color5"></span><span class="vg_subheader"></span>
                        </div>
                    </div>
                    <div class="vg-wrap vg-element vg-full gallery_container">
                        <label class="vg-dotted-square vg-center" draggable="false">
                            <img src="/core/admin/view/img/plus.png" alt="plus" draggable="false">
                            <input class="gallery_img" style="display: none;" type="file" name="new_gallery_img[]" multiple="" accept="image/*,image/jpeg,image/png,image/gif" draggable="false">
                        </label>
                        <a href="/admin/delete/goods/53/new_gallery_img/ODQwLTg0MDMxNjlfZG93bmxvYWQtc3ZnLWRvd25sb2FkLXBuZy1kb2N0b3ItZW1vamlfMDNjYjAwNmQucG5n" class="vg-dotted-square vg-center" draggable="true">
                            <img class="vg_delete" src="/userfiles/840-8403169_download-svg-download-png-doctor-emoji_03cb006d.png" draggable="false">
                        </a>
                        <a href="/admin/delete/goods/53/new_gallery_img/a2lzc3BuZy1lYXJyaW5nLWpld2VsbGVyeS1nZW1zdG9uZS1kaWFtb25kLWdvbGQtcmluZ3MtcG5nLWNsaXBhcnQtNWE3ODIzOTU0NGM0YjMyODg0NTUxMjE1MTc4MjI4NjkyODE3LnBuZw==" class="vg-dotted-square vg-center" draggable="true">
                            <img class="vg_delete" src="/userfiles/kisspng-earring-jewellery-gemstone-diamond-gold-rings-png-clipart-5a78239544c4b32884551215178228692817.png" draggable="false">
                        </a>
                        <div class="vg-dotted-square vg-center empty_container" draggable="false"></div><div class="vg-dotted-square vg-center empty_container" draggable="false"></div>                    </div>
                </div>
            </div>
            <div class="vg-element vg-full vg-left vg-box-shadow">
                <div class="vg-wrap vg-element vg-full vg-box-shadow">
                    <div class="vg-element vg-full vg-left">
                        <span class="vg-header ui-sortable-handle">Фильтры</span>
                    </div>
                    <div class="vg-element vg-full vg-input vg-relative vg-space-between select_wrap">
                        <span class="vg-text vg-left">Color</span>
                        <span class="vg-text vg-right select_all">Выделить все</span>
                    </div>
                    <div class="option_wrap">
                        <label class="custom_label" for="25-17">
                            <div>
                                <input id="25-17" type="checkbox" name="filters[25][17][id]" value="17">
                                <span class="custom_check backgr_bef"></span>
                                <span class="label">red</span>
                            </div>
                        </label>
                        <label class="custom_label" for="25-18">
                            <div>
                                <input id="25-18" type="checkbox" name="filters[25][18][id]" value="18">
                                <span class="custom_check backgr_bef"></span>
                                <span class="label">green</span>
                            </div>
                        </label>
                        <label class="custom_label" for="25-24">
                            <div>
                                <input id="25-24" type="checkbox" name="filters[25][24][id]" value="24">
                                <span class="custom_check backgr_bef"></span>
                                <span class="label">lightred</span>
                            </div>
                        </label>
                    </div>
                    <div class="vg-element vg-full vg-input vg-relative vg-space-between select_wrap">
                        <span class="vg-text vg-left">height</span>
                        <span class="vg-text vg-right select_all">Выделить все</span>
                    </div>
                    <div class="option_wrap">
                        <label class="custom_label" for="29-31">
                            <div>
                                <input id="29-31" type="checkbox" name="filters[29][31][id]" value="31">
                                <span class="custom_check backgr_bef"></span>
                                <span class="label">2px</span>
                            </div>
                        </label>
                        <label class="custom_label" for="29-30">
                            <div>
                                <input id="29-30" type="checkbox" name="filters[29][30][id]" value="30">
                                <span class="custom_check backgr_bef"></span>
                                <span class="label">1 px</span>
                            </div>
                        </label>
                        <label class="custom_label" for="29-32">
                            <div>
                                <input id="29-32" type="checkbox" name="filters[29][32][id]" value="32">
                                <span class="custom_check backgr_bef"></span>
                                <span class="label">3px</span>
                            </div>
                        </label>
                    </div>
                    <div class="vg-element vg-full vg-input vg-relative vg-space-between select_wrap">
                        <span class="vg-text vg-left">Width</span>
                        <span class="vg-text vg-right select_all">Выделить все</span>
                    </div>
                    <div class="option_wrap">
                        <label class="custom_label" for="26-19">
                            <div>
                                <input id="26-19" type="checkbox" name="filters[26][19][id]" value="19">
                                <span class="custom_check backgr_bef"></span>
                                <span class="label">200mm</span>
                            </div>
                        </label>
                        <label class="custom_label" for="26-20">
                            <div>
                                <input id="26-20" type="checkbox" name="filters[26][20][id]" value="20">
                                <span class="custom_check backgr_bef"></span>
                                <span class="label">300mm</span>
                            </div>
                        </label>
                        <label class="custom_label" for="26-23">
                            <div>
                                <input id="26-23" type="checkbox" name="filters[26][23][id]" value="23">
                                <span class="custom_check backgr_bef"></span>
                                <span class="label">400mm</span>
                            </div>
                        </label>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="vg-wrap vg-element right-block">
        <div class="vg-full vg-firm-background-color4 vg-box-shadow">
            <div class="vg-wrap vg-element vg-full vg-box-shadow img_container img_wrapper">
                <div class="vg-wrap vg-element vg-half">
                    <div class="vg-wrap vg-element vg-full">
                        <div class="vg-element vg-full vg-left">
                            <span class="vg-header">main_img</span>
                        </div>
                        <div class="vg-element vg-full vg-left">
                            <span class="vg-text vg-firm-color5"></span><span class="vg_subheader"></span>
                        </div>
                    </div>
                    <div class="vg-wrap vg-element vg-full">
                        <label for="main_img" class="vg-wrap vg-full file_upload vg-left">
                            <span class="vg-element vg-full vg-input vg-text vg-left vg-button" style="float: left; margin-right: 10px">Выбрать</span>
                            <a style="color:black" href="/admin/delete/goods/53/main_img/ODQwLTg0MDMxNjlfZG93bmxvYWQtc3ZnLWRvd25sb2FkLXBuZy1kb2N0b3ItZW1vamkucG5n" class="vg-element vg-full vg-input vg-text vg-left vg-button vg_delete">
                                <span>Удалить</span>
                            </a>
                            <input id="main_img" type="file" name="main_img" class="single_img" accept="image/*,image/jpeg,image/png,image/gif">
                        </label>
                    </div>
                    <div class="vg-wrap vg-element vg-full">
                        <div class="vg-element vg-left img_show main_img_show">
                            <img src="/userfiles/840-8403169_download-svg-download-png-doctor-emoji.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="vg-wrap vg-element content_block">
    </div>-->
    <div class="vg-wrap vg-element vg-full">
        <div class="vg-wrap vg-element vg-full vg-firm-background-color4 vg-box-shadow">
            <div class="vg-element vg-half vg-left">
                <div class="vg-element vg-padding-in-px">
                    <input type="submit" class="vg-text vg-firm-color1 vg-firm-background-color4 vg-input vg-button" value="Сохранить">
                </div>
                <div class="vg-element vg-padding-in-px">
                    <a href="/admin/shop/delete/table/shop_products/id_row/id/id/92" class="vg-text vg-firm-color1 vg-firm-background-color4 vg-input vg-button vg-center vg_delete">
                        <span>Удалить</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>
