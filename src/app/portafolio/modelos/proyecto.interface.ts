export class Proyecto {
  constructor(
    public categoria: string,
    public IdImagen: number,
    public Cliente: string,
    public Trabajo_Realizado: string,
    public Descripcion?: string,
    public Tiempo_Invertido?: any,
    public Programas_Utilizados?: string,
    public Fecha_Elaborado?: any,
    public IdProyecto?: number,
    public IdCategoria?: number
  ){}
}
