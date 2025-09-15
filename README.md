# Admin-Rasil

**Repositorio:** https://github.com/HasselGR/admin-rasil  
**Estado del repo (verificado):** público. :contentReference[oaicite:1]{index=1}

---

## Descripción
Admin-Rasil es una aplicación web desarrollada con Laravel diseñada para centralizar y automatizar los procesos administrativos del **Hotel Rasil** (Puerto La Cruz). El sistema reemplaza el manejo disperso de hojas de cálculo por una plataforma única que facilita la gestión de nómina, contabilidad, inventario del comedor, renta de locales y cuentas por cobrar, además de generación de reportes por periodos (quincenas). La implementación y el diseño se documentan en la tesis adjunta. 

---

## Características principales
- Gestión completa de **nómina**: agregar, editar, borrar empleados; registrar pagos, asignaciones y deducciones; cálculo de pagos por quincena.   
- Gestión de **quincenas** y periodos (quincenalmente) como unidad temporal para muchas transacciones (pagos, libros).
- **Libro de Compras y Ventas**: añadir registros, consultar por periodo y generar reportes filtrados por quincena. 
- **Inventario** de insumos y gestión de comedor: unidades de medida, ingredientes, platos (relación muchos-a-muchos), cargos por órdenes y descuentos automáticos de inventario; gestión de cargamentos. 
- **Renta de locales**: crear/editar locales, asignar clientes, crear registros de cobros y pagos (mensualidades).   
- **Clientes y Cuentas por cobrar**: CRUD de clientes, creación/registro y conciliación de cuentas por cobrar, marcación como “pagado” y generación de reportes.   
- Búsqueda y filtros por periodo/quincena para facilitar auditoría y consultas históricas. 
- Interfaz basada en plantillas y componentes pensados para administración (Blade + AdminLTE / Bootstrap).

---

## Tech stack
- **Backend:** PHP + Laravel (MVC). 
- **Base de datos:** PostgreSQL (modelado relacional, ER). 
- **Vistas / Frontend:** Blade (templating), Bootstrap y AdminLTE para UI administrativa. 
- **Testing / Calidad:** incluye pruebas unitarias e integración documentadas en la tesis (pruebas de nómina, libros, renta, cuentas por cobrar).
---
