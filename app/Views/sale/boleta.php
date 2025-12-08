<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boleta de Venta Electrónica</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            background-color: #f5f5f5;
            padding: 20px;
        }
        .boleta-container {
            max-width: 400px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-left { text-align: left; }
        .bold { font-weight: bold; }
        .header h2, .header p { margin: 2px 0; }
        .divider { border-top: 1px dashed #000; margin: 10px 0; }
        .table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .table th, .table td { text-align: left; font-size: 12px; }
        .table th { border-bottom: 1px solid #000; }
        .table td { padding: 4px 0; }
        .total-section { margin-top: 10px; border-top: 1px solid #000; padding-top: 5px; }
        .footer { margin-top: 20px; font-size: 10px; }
        .qr-code { margin: 15px auto; width: 100px; height: 100px; background: #eee; }
        
        @media print {
            body { background: none; }
            .boleta-container { box-shadow: none; border: none; width: 100%; max-width: 100%; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>

<div class="boleta-container">
    <!-- 1. Encabezado -->
    <div class="header text-center">
        <h2 class="bold">BOTICA "LA ESQUINITA"</h2>
        <p>RUC: 20123456789</p>
        <p>Av. Principal 123, Lima, Perú</p>
        <p>Venta de Productos Farmacéuticos</p>
        <p>Tel: (01) 555-1234</p>
        <p>www.boticaesquinita.com</p>
    </div>

    <!-- 2. Título -->
    <div class="text-center mt-3">
        <h3 class="bold" style="margin: 10px 0;">BOLETA DE VENTA ELECTRÓNICA</h3>
        <p>B001-<?php echo str_pad($sale['id'], 8, '0', STR_PAD_LEFT); ?></p>
    </div>

    <div class="divider"></div>

    <!-- 3. Datos del Cliente -->
    <div class="client-info">
        <p><strong>Documento:</strong> 
        <?php 
            // If Client ID is same as Seller ID (and Seller is not Client role), it's an anonymous sale
            $isAnonymous = ($sale['id_usuario'] == $sale['id_vendedor']) && in_array($sale['vendedor_rol'] ?? '', ['admin', 'vendedor']);
            echo $isAnonymous ? 'VENTA AL PÚBLICO' : ($sale['cliente_dni'] ?: 'VENTA AL PÚBLICO'); 
        ?>
        </p>
        <p><strong>Cliente:</strong> 
        <?php 
            echo $isAnonymous ? 'PÚBLICO GENERAL' : (strtoupper($sale['cliente_nombre']) ?: 'PÚBLICO GENERAL'); 
        ?>
        </p>
        <p><strong>Fecha de Emisión:</strong> <?php echo date('d/m/Y H:i:s', strtotime($sale['fecha'])); ?></p>
        <p><strong>Moneda:</strong> SOLES</p>
    </div>

    <div class="divider"></div>

    <!-- 4. Tabla de Productos -->
    <table class="table">
        <thead>
            <tr>
                <th width="50%">Descripción</th>
                <th width="20%" class="text-right">P/U</th>
                <th width="30%" class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                while($d = $detalles->fetch_assoc()): 
                    $subTotal = $d['cantidad'] * $d['precio_unitario'];
            ?>
            <tr>
                <td><?php echo $d['cantidad']; ?> x <?php echo $d['producto_nombre']; ?></td>
                <td class="text-right"><?php echo number_format($d['precio_unitario'], 2); ?></td>
                <td class="text-right"><?php echo number_format($subTotal, 2); ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <div class="divider"></div>

    <!-- 5. Totales -->
    <?php
    $total = $sale['total'];
    $gravado = $total / 1.18;
    $igv = $total - $gravado;
    
    // Función simple de número a letras (placeholder) - Para producción usar librería completa
    function numeroALetras($monto) {
        return "SON: " . number_format($monto, 2) . " SOLES";
    }
    ?>
    <div class="total-section text-right">
        <p>Gravado: S/ <?php echo number_format($gravado, 2); ?></p>
        <p>IGV (18%): S/ <?php echo number_format($igv, 2); ?></p>
        <?php if ($sale['metodo_entrega'] === 'delivery'): ?>
            <p>Delivery: S/ <?php echo number_format($sale['costo_delivery'], 2); ?></p>
        <?php endif; ?>
        <p class="bold" style="font-size: 14px;">TOTAL: S/ <?php echo number_format($total, 2); ?></p>
        <p class="text-left" style="font-size: 10px; margin-top: 5px;"><?php echo numeroALetras($total); ?></p>
    </div>

    <div class="divider"></div>

    <!-- 6. Datos del Vendedor -->
    <div class="seller-info" style="font-size: 11px;">
        <?php
            $sellerDisplay = "ADMIN/SISTEMA"; // Default for client self-service
            if (isset($sale['vendedor_rol']) && in_array($sale['vendedor_rol'], ['admin', 'vendedor'])) {
                $sellerDisplay = strtoupper($sale['vendedor_nombre']);
            }
        ?>
        <p><strong>Vendedor:</strong> <?php echo $sellerDisplay; ?></p>
        <p><strong>Condición de Pago:</strong> Contado</p>
    </div>

    <!-- 7. Código QR -->
    <div class="text-center">
        <!-- Google Chart API QR -->
        <img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo urlencode("BOLETA:".$sale['id']."|TOTAL:".$total."|FECHA:".$sale['fecha']); ?>" alt="QR Code" class="qr-code">
    </div>

    <!-- 8. Hash -->
    <div class="text-center" style="font-size: 9px; word-break: break-all;">
        HASH: <?php echo md5($sale['id'] . $sale['fecha'] . $total); ?>
    </div>

    <!-- 9. Mensaje Legal -->
    <div class="text-center" style="font-size: 10px; margin-top: 10px;">
        Representación impresa de la BOLETA DE VENTA ELECTRÓNICA. Consultar en www.sunat.gob.pe
    </div>

    <!-- 10. Pie de Página -->
    <div class="footer text-center">
        <p>¡Gracias por su preferencia!</p>
        <p>No se aceptan devoluciones</p>
        <p>Revisar el producto antes de retirarse</p>
    </div>
    
    <div class="divider"></div>
    
    <div class="text-center no-print" style="margin-top: 20px;">
        <button onclick="window.print()" style="padding: 10px 20px; font-size: 16px; cursor: pointer; background: #000; color: #fff; border: none; border-radius: 5px;">Imprimir / Descargar PDF</button>
        <br><br>
        <?php
        $backRoute = 'cliente/carrito'; // Default
        if (isset($_SESSION['rol'])) {
            if ($_SESSION['rol'] === 'admin') $backRoute = 'admin/ventas';
            if ($_SESSION['rol'] === 'vendedor') $backRoute = 'vendedor/ventas';
        }
        ?>
        <a href="index.php?route=<?php echo $backRoute; ?>" style="color: #666; text-decoration: underline;">&larr; Volver a Ventas</a>
    </div>

</div>

</body>
</html>
