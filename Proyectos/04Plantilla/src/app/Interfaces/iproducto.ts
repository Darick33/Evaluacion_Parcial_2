export interface IProducto {
  idProductos?: number;
  Codigo_Barras: string;
  Nombre_Producto: string;
  Graba_IVA: number;
  Unidad_Medida_idUnidad_Medida: number; //tabla unidadmedida
  IVA_idIVA: number; //tabla   IVA
  Cantidad: number;
  Valor_Compra: number;
  Valor_Venta: number;
  Proveedores_idProveedores: number; // tabla  proveedor
}
