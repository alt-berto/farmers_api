<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\Inventory;

class InventorySeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
  //
  if ( Inventory::count(  ) == 0 ) {
    //
    Inventory::create( [ #1
      'product_id' => 1,
      'company_id' => NULL,
      'point_id' => NULL,
      'name' => 'Alienware Aurora R7',
      'description' => 'La torre Alienware Aurora cuenta con un diseño meticuloso y delgado, y es la primera de su clase en ofrecer actualizaciones sin herramientas para tarjetas de gráficos, discos duros y memoria.<br/>Diseñada para mantenerse fría.<br/>Inspirada en la ergonomía térmica de la computadora Area-51, la Aurora ofrece una entrada de aire óptima en los paneles frontales y derechos además de un ventilador de extracción en la parte superior, para obtener el máximo flujo de aire y la refrigeración de los componentes internos. ',
      'company_name' => 'DELL',
      'image' => 'awaurorawebp.webp',
      'classification' => '',
      'unit_measurement' => 'Unid',
      'qmin' => 10,
      'qmax' => 50,
      'existence' => 10,
      'availability' => 10,
      'is_active' => true,
      'note' => 'Pre-Registro',
    ] );
    Inventory::create( [ #2
      'product_id' => 1,
      'company_id' => NULL,
      'point_id' => NULL,
      'name' => 'iMac 2021',
      'description' => '* Sumersiva pantalla Retina de 24 pulgadas 4.5 K con amplia gama de colores P3 y 500 nits de brillo.<br/>* El chip Apple M1 ofrece un potente rendimiento con CPU de 8 núcleos y GPU de 7 núcleos.<br/* Diseño increíblemente delgado de 0.453 in en colores vibrantes.<br/* Cámara FaceTime HD de 1080p con M1 ISP para una calidad de vídeo increíble.<br/* Matriz de tres micrófonos de calidad de estudio para llamadas nítidas y grabaciones de voz.<br/* Sistema de sonido de seis altavoces para una experiencia de audio extraordinariamente robusta y de alta calidad.<br/* Hasta 256 GB de almacenamiento ultrarrápido',
      'company_name' => 'Apple',
      'image' => 'imac.webp',
      'classification' => '',
      'unit_measurement' => 'Unid',
      'qmin' => 10,
      'qmax' => 50,
      'existence' => 10,
      'availability' => 10,
      'is_active' => true,
      'note' => 'Pre-Registro',
    ] );
    Inventory::create( [ #3
      'product_id' => 2,
      'company_id' => NULL,
      'point_id' => NULL,
      'name' => 'iPad Pro 2021',
      'description' => '* Chip Apple M1 para un rendimiento de siguiente nivel.<br/>* Impresionante pantalla de retina líquida de 11 pulgadas con promoción, tono verdadero y color ancho P3.<br/>* Sistema de cámara TrueDepth con cámara frontal ultra ancha con escenario central.<br/>* Cámara ancha de 12 MP, cámara ultra ancha de 10 MP y escáner LiDAR para AR envolvente.<br/>* Mantente conectado con Wi-Fi ultrarrápido.<br/>* Ve más lejos con la batería de todo el día.<br/>* Puerto Thunderbolt para conectar a almacenamiento externo rápido, pantallas y muelles',
      'company_name' => 'Apple',
      'image' => 'ipad.png',
      'classification' => '',
      'unit_measurement' => 'Unid',
      'qmin' => 10,
      'qmax' => 50,
      'existence' => 10,
      'availability' => 10,
      'is_active' => true,
      'note' => 'Pre-Registro',
    ] );
    Inventory::create( [ #4
      'product_id' => 2,
      'company_id' => NULL,
      'point_id' => NULL,
      'name' => 'Surface Pro X',
      'description' => '* Sin Wi Fi, no hay problema, además de Wi Fi, cada modelo viene habilitado con una conectividad rápida LTE Advanced Pro.<br/>* Perfecto para tu estilo de vida en movimiento, elegante y delgado, en negro mate, Surface Pro X es de sólo 0.287 in de grosor y comienza a 1.7 libras.<br/>* Ver más y hacer más en una pantalla de 13 pulgadas. Prácticamente de borde a borde PixelSense pantalla táctil y la relación Surface Signature 3:2 te ofrecen el mayor espacio de trabajo posible.<br/>* Alimentado por Qualcomm, el nuevo procesador Microsoft SQ1 personalizado ofrece un rendimiento multitarea, batería de larga duración y conectividad LTE y Wi Fi más rápida.<br/>* Diseño ultra delgado y versátil. Surface Pro X se adapta a ti, transforma de portátil ultradelgado a tableta potente, a estudio portátil. ',
      'company_name' => 'Microsoft',
      'image' => 'surface_pro_x.png',
      'classification' => '',
      'unit_measurement' => 'Unid',
      'qmin' => 10,
      'qmax' => 50,
      'existence' => 10,
      'availability' => 10,
      'is_active' => true,
      'note' => 'Pre-Registro',
    ] );
    Inventory::create( [ #5
      'product_id' => 3,
      'company_id' => NULL,
      'point_id' => NULL,
      'name' => 'iPhone 12 Pro Max',
      'description' => 'El Apple iPhone 12 Pro Max es la variante con mayor tamaño de pantalla de la serie iPhone 12. Con una pantalla OLED de 6.7 pulgadas, el iPhone 12 Pro Max cuenta con un procesador Apple A14 Bionic con opciones de 128GB, 256GB, o 512GB de almacenamiento, cámara cuádruple con tres lentes de 12 megapixels más un lente TOF 3D de tecnología LiDAR, cámara selfie de 12 megapixels, estabilización de imagen, zoom óptico 5x, parlantes stereo, carga rápida e inalámbrica por MagSafe para iPhone o protocolo Qi, resistencia al polvo y agua con certificación iP68, y corre iOS 14.',
      'company_name' => 'Apple',
      'image' => 'iphone12.jpg',
      'classification' => '',
      'unit_measurement' => 'Unid',
      'qmin' => 10,
      'qmax' => 50,
      'existence' => 10,
      'availability' => 10,
      'is_active' => true,
      'note' => 'Pre-Registro',
    ] );
    Inventory::create( [ #6
      'product_id' => 3,
      'company_id' => NULL,
      'point_id' => NULL,
      'name' => 'Surface Duo',
      'description' => '* Espacio para enfocar con dos pantallas. Abre y mira dos aplicaciones a la vez o extiende una en ambas pantallas.<br/> * Flexibilidad para hacer más. Elige tu modo para la tarea a mano y haz frente a tareas con aplicaciones mejoradas de doble pantalla.<br/> * Obtén lo mejor de las experiencias móviles Microsoft 365 y cada aplicación Android en la Google Play Store.<br/> * Diseño original, creado por superficie. Diseño delgado, ligero y versátil que hace lo que quieras, con una revolucionaria bisagra de 360° y pantallas de fusión Dual PixelSense.<br/> * sostén como un libro, obtén más pantalla cuando lo necesites, toma notas, haz llamadas o mira un programa favorito.<br/> * Sistema operativo: Android 10.0.<br/> * Tipo de conector: USB tipo C. ',
      'company_name' => 'Microsoft',
      'image' => 'surface_duo.jpg',
      'classification' => '',
      'unit_measurement' => 'Unid',
      'qmin' => 10,
      'qmax' => 50,
      'existence' => 10,
      'availability' => 10,
      'is_active' => true,
      'note' => 'Pre-Registro',
    ] );
  }
  }
}
