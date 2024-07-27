<footer class="footer">
                    © 2024 IMAMD.
                </footer>

            </div>
            <!-- End Right content here -->

        </div>
        <!-- END wrapper -->


        
         <!-- jQuery  -->
         <script src="<?=base_url();?>assets/js/jquery.min.js"></script>
        <script src="<?=base_url();?>assets/js/popper.min.js"></script>
        <script src="<?=base_url();?>assets/js/bootstrap-material-design.js"></script>
        <script src="<?=base_url();?>assets/js/modernizr.min.js"></script>
        <script src="<?=base_url();?>assets/js/detect.js"></script>
        <script src="<?=base_url();?>assets/js/fastclick.js"></script>
        <script src="<?=base_url();?>assets/js/jquery.slimscroll.js"></script>
        <script src="<?=base_url();?>assets/js/jquery.blockUI.js"></script>
        <script src="<?=base_url();?>assets/js/waves.js"></script>
        <script src="<?=base_url();?>assets/js/jquery.nicescroll.js"></script>
        <script src="<?=base_url();?>assets/js/jquery.scrollTo.min.js"></script>
        <script src="<?=base_url();?>assets/plugins/carousel/owl.carousel.min.js"></script>
        <script src="<?=base_url();?>assets/plugins/fullcalendar/vanillaCalendar.js"></script>
        <script src="<?=base_url();?>assets/plugins/peity/jquery.peity.min.js"></script>
        <script src="<?=base_url();?>assets/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
        <script src="<?=base_url();?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <script src="<?=base_url();?>assets/plugins/chartist/js/chartist.min.js"></script>
        <script src="<?=base_url();?>assets/plugins/chartist/js/chartist-plugin-tooltip.min.js"></script>
        <script src="<?=base_url();?>assets/plugins/metro/MetroJs.min.js"></script>
        <script src="<?=base_url();?>assets/plugins/raphael/raphael.min.js"></script>
        <script src="<?=base_url();?>assets/plugins/morris/morris.min.js"></script>
        <script src="<?=base_url();?>assets/pages/dashborad.js"></script>

        <!-- App js -->
        <script src="<?=base_url();?>assets/js/app.js"></script>
         <!-- Responsive examples -->
         <script src="<?=base_url();?>assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="<?=base_url();?>assets/plugins/datatables/responsive.bootstrap4.min.js"></script>
        <script src="<?=base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?=base_url();?>assets//plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="<?=base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?=base_url();?>assets/plugins/datatables/dataTables.bootstrap4.min.js"></script> 
        <!-- Datatable init js -->
        <script src="<?=base_url();?>assets/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="<?=base_url();?>assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
        <script src="<?=base_url();?>assets/plugins/datatables/jszip.min.js"></script>
        <script src="<?=base_url();?>assets/plugins/datatables/pdfmake.min.js"></script>
        <script src="<?=base_url();?>assets/plugins/datatables/vfs_fonts.js"></script>
        <script src="<?=base_url();?>assets/plugins/datatables/buttons.html5.min.js"></script>
        <script src="<?=base_url();?>assets/plugins/datatables/buttons.print.min.js"></script>
        <script src="<?=base_url();?>assets/plugins/datatables/buttons.colVis.min.js"></script>
        <script src="<?=base_url();?>assets/pages/datatables.init.js"></script>
        <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search-menu');
        searchInput.addEventListener('input', function() {
            const filter = searchInput.value.toLowerCase();
            const menuItems = document.querySelectorAll('#sidebar-menu ul li');

            menuItems.forEach(function(item) {
                const text = item.textContent.toLowerCase();
                if (text.includes(filter)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
</script>

       
    </body>

</html>
