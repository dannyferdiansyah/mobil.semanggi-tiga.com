<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
      &copy; 2025 Copyright <strong><span>PT Semanggi Tiga</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="https://semanggi-tiga.com/">PT Semanggi Tiga</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?php echo base_url() ?>assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/chart.js/chart.umd.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/echarts/echarts.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/quill/quill.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/php-email-form/validate.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/simple-datatables/simple-datatables.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Template Main JS File -->
  <script src="<?php echo base_url() ?>assets/js/main.js"></script>
  <script>
  function printSpecificArea() {
    var printContents = document.getElementById('printArea').innerHTML;
    var printFrame = document.createElement('iframe');

    printFrame.style.position = 'absolute';
    printFrame.style.width = '0';
    printFrame.style.height = '0';
    printFrame.style.border = 'none';

    document.body.appendChild(printFrame);

    var frameDoc = printFrame.contentWindow.document;
    frameDoc.open();
    frameDoc.write(`
        <html>
        <head>
            <title>Print Preview</title>
            <style>
                @media print {
                    @page {
                        size: auto;
                        margin: 10mm;
                    }
                }
                body {
                    margin: 0;
                    padding: 0;
                }
            </style>
        </head>
        <body>${printContents}</body>
        </html>
    `);
    frameDoc.close();

    printFrame.contentWindow.focus();
    printFrame.contentWindow.print();

    document.body.removeChild(printFrame);
}
</script>

</body>

</html>