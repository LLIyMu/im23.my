<div class="vg-wrap vg-element vg-full vg-box-shadow">
    <div class="vg-wrap vg-element vg-full vg-box-shadow">
        <div class="vg-wrap vg-element vg-full">
            <div class="vg-element vg-full vg-left">
                <span class="vg-header"><?=$this->translate[$row][0] ?: $row?></span>
            </div>
            <div class="vg-element vg-full vg-left">
                <span class="vg-text vg-firm-color5">
                    <span class="vg_subheader">
                        <?=$this->translate[$row][1]?>
                    </span>
                </span>
            </div>
        </div>
        <div class="vg-element vg-full">
            <div class="vg-element vg-full vg-left" style="flex-wrap: wrap">
                <div style="width: 100%; margin-bottom: 10px">
                    <label>
                        <input type="checkbox" class="tinyMceInit" style="display: inline" <?= $class === 'content-block' ? 'checked' : ''?>>
                        Визуальный режим
                    </label>
                </div>
                <textarea name="<?=$row?>" class="vg-input vg-text vg-full vg-firm-color1"><?= isset($_SESSION['res'][$row]) ? htmlspecialchars($_SESSION['res'][$row]): htmlspecialchars($this->data[$row])?></textarea>
            </div>
        </div>
    </div>
</div>