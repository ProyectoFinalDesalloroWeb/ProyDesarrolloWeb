# ProyDesarrolloWeb
Este proyecto es un ERP colaborativo para una empresa de dulces, con módulos para gestionar materias primas, productos terminados, ventas, clientes y contabilidad. Utilizamos GitHub y una metodología ágil para desarrollar cada módulo, promoviendo la eficiencia operativa a través de una integración completa de las operaciones empresariales.

                                                 Herramientas Necesarias
#Herramientas de Desarrollo

•	Composer: Versión 2.7.7
•	PHP: Versión 8.2.12
•	XAMPP
•	MySQL Workbench

#Extensiones de PHP

•	GD: Biblioteca gráfica para crear y manipular imágenes (soporta formatos como JPEG, PNG, GIF, etc.).

#Comandos para Instalar Paquetes Necesarios
1.	Agregar scaffolding para autenticación en Laravel:
composer require laravel/ui
2.	Agregar funcionalidad para generar PDFs:
composer require barryvdh/laravel-dompdf

#Descripción de los Comandos:

laravel/ui: Añade interfaces básicas de autenticación (registro, login, etc.).
barryvdh/laravel-dompdf: Permite generar archivos PDF a partir de HTML.

#Instalación de la Extensión GD
La extensión GD es esencial para la manipulación de imágenes en PHP. Asegúrate de que esté habilitada en tu entorno PHP.

#Cómo verificar e instalar GD:

1.	Verificar si GD está instalada:
Crea un archivo info.php con el siguiente contenido
<?php phpinfo(); ?>

Accede a http://localhost/info.php en tu navegador y busca la sección GD.

2.	Si GD no está instalada:
Abre el archivo php.ini de tu instalación de PHP.
Descomenta la línea que contiene extension=gd (elimina el punto y coma ; al inicio).
Reinicia el servidor de XAMPP para aplicar los cambios.

#Instalación del Proyecto desde GitHub

Existen dos métodos para clonar e instalar el proyecto: usando la Terminal o GitHub Desktop. A continuación, se detallan ambos métodos.

#Método 1: Usando la Terminal
Clonar el Repositorio:
1.	Abre la terminal y navega a la carpeta donde deseas clonar el proyecto.
Ejecuta:

git clone https://github.com/ProyectoFinalDesalloroWeb/ProyDesarrolloWeb.git

Esto creará una carpeta llamada ProyDesarrolloWeb.
2.	Ingresar al Directorio del Proyecto:

cd ProyDesarrolloWeb

3.	Instalar las Dependencias:

composer install

4.	Configurar las Variables de Entorno:

Copia el archivo .env.example y renómbralo a .env.
Configura los parámetros necesarios (como la conexión a la base de datos).

5.	Configurar la Base de Datos:

Abre MySQL Workbench.
Crea una base de datos llamada Dulceriaumg.

6.	Migrar las Tablas a la Base de Datos:

php artisan migrate

7.	Iniciar el Servidor de Desarrollo:

php artisan serve

Accede al proyecto en tu navegador a través de la URL que se muestra en la terminal (usualmente http://127.0.0.1:8000).

#Método 2: Usando GitHub Desktop

1.	Descargar e Instalar GitHub Desktop:

https://desktop.github.com/

2.	Clonar el Repositorio:

Abre GitHub Desktop.
Haz clic en el botón “Clone a repository”.
En la pestaña URL, ingresa

https://github.com/ProyectoFinalDesalloroWeb/ProyDesarrolloWeb.git

Selecciona la carpeta de destino en tu computadora y haz clic en “Clone”.

3.	Abrir el Proyecto en Visual Studio Code:
Una vez clonado, en GitHub Desktop, asegúrate de estar en la rama main.
Haz clic en el botón “Open in Visual Studio Code”.
Visual Studio Code se abrirá con el proyecto listo para trabajar.

4.	Continuar con los Pasos de la Terminal:
Abre la terminal integrada en Visual Studio Code (puedes usar el atajo Ctrl + \).

#Sigue los pasos del Método 1 desde el paso 3:
•	Instalar dependencias con composer install.
•	Configurar las variables de entorno.
•	Configurar la base de datos.
•	Migrar las tablas.
•	Iniciar el servidor con php artisan serve.

                                                                  Funcionalidades Generales
Inicio de sesión:

Permite a los usuarios acceder al sistema mediante un formulario de autenticación, con la validación de credenciales.

Registro de usuario:

Facilita la creación de nuevos usuarios para acceder al ERP.

Vista de inicio:

La vista de inicio para empleados de Dulcería UMG está diseñada para brindarles información relevante sobre la empresa, su historia, y los valores que guían su misión. En esta sección, los empleados pueden acceder a una galería de fotos del equipo, asambleas y eventos internos, y recibir noticias importantes. Además, se facilita el contacto con Recursos Humanos para cualquier consulta relacionada con el trabajo, promoviendo un ambiente de comunicación abierta y colaborativa dentro de la empresa.

                                                                  MODULO 1
Gestión de Materias Primas

Crear materia prima:

Permite registrar nuevas materias primas necesarias para la producción de dulces. Se le pedirá al usuario que ingrese los siguientes datos: nombre, descripción, unidad de medida, cantidad, precio unitario, proveedor, fecha de adquisición y fecha de expiración, para guardar una nueva materia prima.

Visualizar materia prima:

Permite a los usuarios ver todas las materias primas registradas en el inventario en un formato de tabla. Esta vista organizada proporciona información detallada de cada materia prima, facilitando la gestión y la toma de decisiones sobre los insumos disponibles para la producción de dulces.

Editar materia prima:

Facilita la modificación de la información de una materia prima existente. El usuario podrá actualizar los datos relevantes de una materia prima ya registrada.

Eliminar materia prima:

Posibilita eliminar una materia prima del sistema si ya no es necesaria. Esto ayuda a mantener el inventario actualizado y libre de insumos obsoletos o no utilizados.

Buscar materia prima por nombre:

Incluye una función de búsqueda que permite encontrar materias primas fácilmente mediante su nombre o parte de este.

Visualizar el Registro de Movimientos de Materia Prima:

Muestra un historial detallado de los movimientos de cada materia prima, indicando el nombre del insumo, el tipo de movimiento (entrada o salida), la cantidad y la fecha. Este registro es útil para rastrear el uso y disponibilidad de las materias primas a lo largo del 
tiempo.

                                                                  MODULO 2
                                                                  
Gestión de Productos Terminados (Dulces)

Crear dulce - primer paso:

En esta etapa, el sistema solicita al usuario los datos principales para crear el producto terminado. El usuario debe ingresar el nombre del dulce, la existencia o cantidad disponible, una breve descripción, el precio unitario de venta, la fecha de ingreso al inventario en formato dd/mm/aaaa, y la fecha de vencimiento.

Crear dulce - segundo paso:

Después de ingresar los datos principales del dulce, el sistema dirige al usuario a una nueva vista en la que se seleccionan las materias primas disponibles en el inventario. El usuario debe elegir las materias primas necesarias y especificar las cantidades que se usarán para producir el dulce. Una vez completado este paso, se ajusta automáticamente el inventario de las materias primas y se crea el producto terminado.

Visualizar dulces disponibles:

La funcionalidad de Visualización de Dulces Disponibles permite a los usuarios ver una tabla con todos los productos terminados (dulces) en el inventario. Esta tabla contiene la información clave para gestionar los productos terminados, incluyendo su nombre, existencia, descripción, precio por unidad, fecha de ingreso y fecha de vencimiento.

Editar dulce:

Proporciona la opción de modificar los detalles de un producto terminado ya existente. Los usuarios pueden cambiar el nombre, la cantidad disponible, la descripción, el precio por unidad, la fecha de ingreso y la fecha de vencimiento.

Eliminar dulce:

Funcionalidad que permite eliminar un producto terminado del inventario. Esto también afectará la relación con las materias primas asociadas, lo que asegura que los recursos no se vean comprometidos por productos que ya no están disponibles.

                                                                  MODULO 3
                                                                  
Gestión de Ventas

Registro de la transacción:

Este proceso de ventas permite registrar una transacción para un cliente específico. El sistema solicita al usuario que ingrese el nombre del cliente, seguido del producto que desea adquirir y la cantidad correspondiente. El sistema validará si existe suficiente inventario del producto solicitado, asegurando que la cantidad requerida esté disponible para la venta.

Adición al listado de productos:

Si la cantidad solicitada es válida, el producto se agregará al listado de compras del cliente junto con la cantidad deseada. Este proceso se repetirá de manera sucesiva, permitiendo que el usuario registre todos los dulces que el cliente necesita. Al finalizar, se generará un resumen de la transacción, que incluirá todos los productos y cantidades compradas, facilitando la gestión de ventas.

Proceso de eliminación:

Durante el proceso de ventas, si el cliente decide que ya no quiere un producto que ha añadido a su lista de compras o si se ha producido alguna confusión en la selección de productos, el sistema permite eliminar el producto del listado. El usuario puede seleccionar el producto específico que desea eliminar y confirmar la acción.

Actualización del listado:

Una vez que el producto es eliminado, el sistema actualizará automáticamente el listado de compras del cliente, reflejando la cantidad ajustada y asegurando que el resumen de la transacción sea preciso. Este proceso garantiza que el cliente solo pague por los productos que realmente desea adquirir, mejorando la experiencia de compra.

Finalización de la transacción:

Una vez que el usuario ha revisado y confirmado el listado de productos que el cliente desea adquirir, deberá presionar el botón "Guardar Venta". Al hacer esto, el sistema registrará la transacción en la base de datos, asegurando que toda la información relacionada con la venta, incluidos los detalles del cliente y los productos comprados, se almacene correctamente.

Redirección al menú principal:

Tras guardar la venta, el sistema redirigirá al usuario a la pestaña principal donde podrá elegir entre crear una nueva venta o ver las ventas realizadas anteriormente. Esto facilita la gestión de las transacciones y permite al usuario realizar nuevas operaciones de manera eficiente.

Visualización de ventas:

En la pestaña de Listado de Ventas, se mostrará una tabla que contiene todas las ventas realizadas. Esta tabla incluirá información clave, como la fecha de la transacción, el nombre del cliente y los productos vendidos. Este listado proporciona una vista clara y organizada de las transacciones, facilitando la gestión y el seguimiento de las ventas.

Generación de PDF por venta:

Cada venta en el listado tendrá la opción de generar un PDF específico. Al seleccionar la opción de descarga junto a una venta, se creará un documento en formato PDF que incluirá todos los detalles de esa transacción en particular. 

                                                                  MODULO 4
                                                                  
Gestión de Clientes

Crear cliente:

Esta funcionalidad permite agregar un nuevo cliente al sistema. Al crear un cliente, el sistema generará automáticamente un código único para identificarlo. Se solicitarán los datos necesarios, como nombre, correo electrónico, teléfono, y dirección, así como información adicional como género, NIT, número de DPI, nombre del representante legal, fecha de registro, tipo de cliente, departamento y municipio.

Ver clientes:

En la pestaña de gestión, se presentará un listado de todos los clientes registrados. 

Editar cliente:

Esta opción permite modificar los datos de un cliente existente. Al seleccionar un cliente del listado, el usuario podrá actualizar cualquier información necesaria, asegurando que los registros sean precisos y estén al día.

Eliminar cliente:

Los usuarios pueden eliminar a un cliente del sistema si ya no es necesario. Esta función garantiza que la base de datos se mantenga organizada y actualizada.

Buscar cliente por nombre o código:

El sistema cuenta con una función de búsqueda que permite localizar clientes utilizando su nombre o código, mejorando la eficiencia al gestionar la información de los clientes.

Ver historial de compras del cliente:

Al acceder a esta sección, se presentará una tabla que muestra el historial de compras de todos los clientes registrados en el sistema. La tabla incluirá información relevante como ID, código cliente, cliente, NIT, fecha de venta, dirección y acciones. Esto permite a los usuarios ver todas las transacciones realizadas por cada cliente en particular. Además, se incluirá una funcionalidad de filtro que permitirá a los usuarios buscar y ver las transacciones de un cliente específico mediante su nombre o código. Esta opción facilita la gestión de compras y permite un seguimiento más efectivo de las transacciones de los clientes.

Ver Detalles de la compra: 

Al seleccionar esta opción, se abrirá una pestaña que mostrará toda la información relacionada con la compra, incluyendo los productos adquiridos, cantidades, precios y el total de la transacción.

Descargar factura de la compra: 

Esta opción permitirá al usuario generar y descargar un PDF con la factura correspondiente a la compra seleccionada, facilitando así la gestión de documentos y la transparencia en las transacciones.

                                                                  MODULO 5

Control Financiero

Movimientos de bancos:

La sección de Movimientos de Bancos presenta un registro detallado de las transacciones financieras de la empresa, donde se muestra la fecha, una descripción del movimiento, el tipo (ingreso o egreso), el monto del movimiento y el saldo de la cuenta bancaria tras cada transacción. Al final de la tabla, se refleja el total de ingresos y egresos para ofrecer un resumen financiero claro.

Búsquedas y filtros:

La funcionalidad de búsqueda por fecha permite al usuario filtrar los movimientos según un rango específico de fechas. Además, es posible aplicar filtros que muestren únicamente ingresos, egresos o todos los movimientos, proporcionando flexibilidad para revisar el flujo financiero de la empresa según las necesidades.

Generar resumen financiero en PDF:

Posibilidad de generar un informe detallado en PDF con el resumen financiero de la empresa, mostrando ingresos, egresos y el balance final, firmada por el gerente financiero.

