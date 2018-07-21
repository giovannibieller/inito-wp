<div class="flexible_contents">
    <?php if( have_rows('contents') ): while ( have_rows('contents') ) : the_row(); ?>
        <?php if( get_row_layout() == 't' ): 
            $t_t1 = apply_filters( 'the_content', get_sub_field('t1') );
        ?>
            <div class="flexible_contents_section">
                <div class="flexible_contents_section--t">
                    <?php echo $t_t1; ?>
                </div>
            </div>
        <?php elseif( get_row_layout() == 'tt_dc' ): 
            $tt_dc_t1 = apply_filters( 'the_content', get_sub_field('t1') );
        ?>
            <div class="flexible_contents_section">
                <div class="flexible_contents_section--tt flexible_contents_section--tt--double_col">
                    <?php echo $tt_dc_t1; ?>
                </div>
            </div>
        <?php elseif( get_row_layout() == 'tt' ): 
            $tt_t1 = apply_filters( 'the_content', get_sub_field('t1') );
            $tt_t2 = apply_filters( 'the_content', get_sub_field('t2') );
        ?>
            <div class="flexible_contents_section">
                <div class="flexible_contents_section--tt">
                    <div class="grido grido--pads">
                        <div class="gc_6 gc_12_sm">
                            <?php echo $tt_t1; ?>    
                        </div>
                        <div class="gc_6 gc_12_sm">
                            <?php echo $tt_t2; ?>    
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif( get_row_layout() == 'ttt' ): 
            $ttt_t1 = apply_filters( 'the_content', get_sub_field('t1') );
            $ttt_t2 = apply_filters( 'the_content', get_sub_field('t2') );
            $ttt_t3 = apply_filters( 'the_content', get_sub_field('t3') );
        ?>
            <div class="flexible_contents_section">
                <div class="flexible_contents_section--ttt">
                    <div class="grido grido--pads">
                        <div class="gc_4 gc_12_sm">
                            <?php echo $ttt_t1; ?>    
                        </div>
                        <div class="gc_4 gc_12_sm">
                            <?php echo $ttt_t2; ?>    
                        </div>
                        <div class="gc_4 gc_12_sm">
                            <?php echo $ttt_t3; ?>    
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif( get_row_layout() == 'tttt' ): 
            $tttt_t1 = apply_filters( 'the_content', get_sub_field('t1') );
            $tttt_t2 = apply_filters( 'the_content', get_sub_field('t2') );
            $tttt_t3 = apply_filters( 'the_content', get_sub_field('t3') );
            $tttt_t4 = apply_filters( 'the_content', get_sub_field('t4') );
        ?>
            <div class="flexible_contents_section">
                <div class="flexible_contents_section--tttt">
                    <div class="grido grido--pads">
                        <div class="gc_3 gc_12_sm">
                            <?php echo $tttt_t1; ?>    
                        </div>
                        <div class="gc_3 gc_12_sm">
                            <?php echo $tttt_t2; ?>    
                        </div>
                        <div class="gc_3 gc_12_sm">
                            <?php echo $tttt_t3; ?>    
                        </div>
                        <div class="gc_3 gc_12_sm">
                            <?php echo $tttt_t4; ?>    
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif( get_row_layout() == 'i' ): 
            $i_i1 = get_sub_field('i1')['url'];
            $i_i1_tit = get_sub_field('i1')['title'];
        ?>
            <div class="flexible_contents_section">
                <div class="flexible_contents_section--i">
                    <img src="<?php echo $i_i1; ?>" alt="<?php echo $i_i1_tit; ?>">
                </div>
            </div>
        <?php elseif( get_row_layout() == 'ii' ): 
            $ii_i1 = get_sub_field('i1')['url'];
            $ii_i1_tit = get_sub_field('i1')['title'];
            $ii_i2 = get_sub_field('i2')['url'];
            $ii_i2_tit = get_sub_field('i2')['title'];
        ?>
            <div class="flexible_contents_section">
                <div class="flexible_contents_section--ii">
                    <div class="grido grido--pads">
                        <div class="gc_6 gc_12_sm">
                            <img src="<?php echo $ii_i1; ?>" alt="<?php echo $ii_i1_tit; ?>">
                        </div>
                        <div class="gc_6 gc_12_sm">
                            <img src="<?php echo $ii_i2; ?>" alt="<?php echo $ii_i2_tit; ?>">
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif( get_row_layout() == 'iii' ): 
            $iii_i1 = get_sub_field('i1')['url'];
            $iii_i1_tit = get_sub_field('i1')['title'];
            $iii_i2 = get_sub_field('i2')['url'];
            $iii_i2_tit = get_sub_field('i2')['title'];
            $iii_i3 = get_sub_field('i3')['url'];
            $iii_i3_tit = get_sub_field('i3')['title'];
        ?>
            <div class="flexible_contents_section">
                <div class="flexible_contents_section--iii">
                    <div class="grido grido--pads">
                        <div class="gc_4 gc_12_sm">
                            <img src="<?php echo $iii_i1; ?>" alt="<?php echo $iii_i1_tit; ?>">
                        </div>
                        <div class="gc_4 gc_12_sm">
                            <img src="<?php echo $iii_i2; ?>" alt="<?php echo $iii_i2_tit; ?>">
                        </div>
                        <div class="gc_4 gc_12_sm">
                            <img src="<?php echo $iii_i3; ?>" alt="<?php echo $iii_i3_tit; ?>">
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif( get_row_layout() == 'it' ): 
            $it_i1 = get_sub_field('i1')['url'];
            $it_i1_tit = get_sub_field('i1')['title'];
            $it_t1 = apply_filters( 'the_content', get_sub_field('t1') );
        ?>
            <div class="flexible_contents_section">
                <div class="flexible_contents_section--it">
                    <div class="grido grido--pads">
                        <div class="gc_6 gc_12_sm">
                            <img src="<?php echo $it_i1; ?>" alt="<?php echo $it_i1_tit; ?>">
                        </div>
                        <div class="gc_6 gc_12_sm">
                            <?php echo $it_t1; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif( get_row_layout() == 'ti' ): 
            $ti_t1 = apply_filters( 'the_content', get_sub_field('t1') );
            $ti_i1 = get_sub_field('i1')['url'];
            $ti_i1_tit = get_sub_field('i1')['title'];
        ?>
            <div class="flexible_contents_section">
                <div class="flexible_contents_section--ti">
                    <div class="grido grido--pads">
                        <div class="gc_6 gc_12_sm">
                            <img src="<?php echo $ti_i1; ?>" alt="<?php echo $ti_i1_tit; ?>">
                        </div>
                        <div class="gc_6 gc_12_sm">
                            <?php echo $ti_t1; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif( get_row_layout() == 'iit' ): 
            $iit_i1 = get_sub_field('i1')['url'];
            $iit_i1_tit = get_sub_field('i1')['title'];
            $iit_i2 = get_sub_field('i2')['url'];
            $iit_i2_tit = get_sub_field('i2')['title'];
            $iit_t1 = apply_filters( 'the_content', get_sub_field('t1') );
        ?>
            <div class="flexible_contents_section">
                <div class="flexible_contents_section--iit">
                    <div class="grido grido--pads">
                        <div class="gc_6 gc_12_sm">
                            <div class="flexible_contents_section--v_i">
                                <img src="<?php echo $iit_i1; ?>" alt="<?php echo $iit_i2_tit; ?>">
                            </div>
                            <div class="flexible_contents_section--v_i">
                                <img src="<?php echo $iit_i2; ?>" alt="<?php echo $iit_i2_tit; ?>">
                            </div>
                        </div>
                        <div class="gc_6 gc_12_sm">
                            <?php echo $iit_t1; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif( get_row_layout() == 'tii' ): 
            $tii_t1 = apply_filters( 'the_content', get_sub_field('t1') );
            $tii_i1 = get_sub_field('i1')['url'];
            $tii_i1_tit = get_sub_field('i1')['title'];
            $tii_i2 = get_sub_field('i2')['url'];
            $tii_i2_tit = get_sub_field('i2')['title'];
        ?>
            <div class="flexible_contents_section">
                <div class="flexible_contents_section--tii">
                    <div class="grido grido--pads">
                        <div class="gc_6 gc_12_sm">
                            <?php echo $tii_t1; ?>
                        </div>
                        <div class="gc_6 gc_12_sm">
                            <div class="flexible_contents_section--v_i">
                                <img src="<?php echo $tii_i1; ?>" alt="<?php echo $tii_i2_tit; ?>">
                            </div>
                            <div class="flexible_contents_section--v_i">
                                <img src="<?php echo $tii_i2; ?>" alt="<?php echo $tii_i2_tit; ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif( get_row_layout() == 'itt' ): 
            $itt_i1 = get_sub_field('i1')['url'];
            $itt_i1_tit = get_sub_field('i1')['title'];
            $itt_t1 = apply_filters( 'the_content', get_sub_field('t1') );
            $itt_t2 = apply_filters( 'the_content', get_sub_field('t2') );
        ?>
            <div class="flexible_contents_section">
                <div class="flexible_contents_section--itt">
                    <div class="grido grido--pads">
                        <div class="gc_6 gc_12_sm">
                            <img src="<?php echo $itt_i1; ?>" alt="<?php echo $itt_i2_tit; ?>">
                        </div>
                        <div class="gc_6 gc_12_sm">
                            <div class="flexible_contents_section--v_t">
                                <?php echo $itt_t1; ?>
                            </div>
                            <div class="flexible_contents_section--v_t">
                                <?php echo $itt_t2; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif( get_row_layout() == 'tti' ): 
            $tti_t1 = apply_filters( 'the_content', get_sub_field('t1') );
            $tti_t2 = apply_filters( 'the_content', get_sub_field('t2') );
            $tti_i1 = get_sub_field('i1')['url'];
            $tti_i1_tit = get_sub_field('i1')['title'];
        ?>
            <div class="flexible_contents_section">
                <div class="flexible_contents_section--tti">
                    <div class="grido grido--pads">
                        <div class="gc_6 gc_12_sm">
                            <div class="flexible_contents_section--v_t">
                                <?php echo $tti_t1; ?>
                            </div>
                            <div class="flexible_contents_section--v_t">
                                <?php echo $tti_t2; ?>
                            </div>
                        </div>
                        <div class="gc_6 gc_12_sm">
                            <img src="<?php echo $tti_i1; ?>" alt="<?php echo $tti_i2_tit; ?>">
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endwhile; endif; ?>
</div>