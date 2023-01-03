<?php
echo "
                <script>
                    window.open('".site_url("/ventas/pdfRemito/".$remito_id)."', '_blank');
                    
                    window.open('".site_url('/ventas/nuevo_remito/')."','_self');
                </script>
                ";




                //Development http://localhost/bright/ventas/nuevo_remito#
                //Production https://bright.admesys.com/