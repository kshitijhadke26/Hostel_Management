

<div class="app-main__outer">
    <div id="refreshData">
    <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="pe-7s-car icon-gradient bg-mean-fruit">
                            </i>
                        </div>
                        <div> <h1> Dashboard </h1>
                            <div class="page-title-subheading" style="color: red">Welcome to Online Exam Management System.  
                            </div>
                        </div>
                    </div>
                 </div>
            </div>            
            
            <div class="row">
                <div class="col-md-6 col-xl-4">
                    <div class="base-card" style="background: linear-gradient(to bottom,rgb(42, 6, 116),rgb(78, 14, 206));">
                        <div class="center-content1 text-white" >
                            <div class="widget-content-left">
                                <div class="content-info" >Total Course</div>
                                <div class="widget-subheading" style="color:transparent;">.</div>
                            </div>
                            <div class="widget-content-center">
                                <div class="content-count">
                                    <span><?php echo $totalCourse = $selCourse['totCourse']; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="base-card" style="background: linear-gradient(to bottom,rgb(90, 116, 6),rgb(159, 204, 11));">
                        <div class="center-content1 text-white">
                            <div class="widget-content-left">
                                <div class="content-info">Total Exam</div>
                                <div class="widget-subheading" style="color:transparent;">.</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="content-count">
                                    <span><?php echo $totalCourse = $selExam['totExam']; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="base-card" style="background: linear-gradient(to bottom,rgb(98, 6, 78),rgb(187, 13, 149));">
                        <div class="center-content1 text-white">
                            <div class="widget-content-left">
                                <div class="content-info">Total Examinee</div>
                                <div class="widget-subheading" style="color:transparent;">.</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="content-count"><span><span><?php echo $totalExaminee = $selExaminee['totExaminee']; ?></span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-xl-none d-lg-block col-md-6 col-xl-4">
                    <div class="card mb-3 widget-content bg-premium-dark">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading">Products Sold</div>
                                <div class="widget-subheading">Revenue streams</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-warning"><span>$14M</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
         
    </div>
