</main>
</div>
</div>

<script src="<?= asset("/asset/adminpanel/js/jquery-3.6.1.slim.min.js") ?>"></script>
<script src="<?= asset('/asset/adminpanel/js/bootstrap.min.js') ?>"></script>
<script src="<?= asset('/asset/adminpanel/js/mdb.min.js') ?>"></script>
<script src="<?= asset('/asset/ckeditor/ckeditor.js') ?>"></script>
<script src="<?= asset('/asset/jalalidatepicker/persian-date.min.js') ?>"></script>
<script src="<?= asset('/asset/jalalidatepicker/persian-datepicker.min.js') ?>"></script>

</body>
<script>
    $(document).ready(function() {
        CKEDITOR.replace('summary');
        CKEDITOR.replace('body');
        $("#published_at_view").persianDatepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            toolbox: {
                calendarSwitch: {
                    enabled: true
                }
            },
            observer: true,
            initialValueType: 'gregorian',
            altField: '#published_at',
        })
    })
</script>

</html>