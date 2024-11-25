const expreNomyApe = /^[a-zA-ZÀ-ÿ\s]{1,40}$/;
const expreDir = /^[a-zA-Z0-9À-ÿ\s]{1,40}$/;
const expreTel = /^\d{7,14}$/;
const expreEmail = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
const patronanio = /^\d{4}-\d{2}-\d{2}$/;

document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("frmlogin").addEventListener("submit", validarLogin);
});

function validarLogin(event) {
  // Prevent form submission initially
  event.preventDefault();

  // Access form and elements
  const frmlogin = document.getElementById("frmlogin");
  const usuario = frmlogin.usuario;
  const contrasena = frmlogin.contrasena;
  const us = document.getElementById("us");
  const con = document.getElementById("con");
  const btn = document.getElementById("btn");

  if (usuario.value.trim().length <= 2 || usuario.value.trim() === "") {
    usuario.focus();
    us.style.display = "";
    return false;
  }
  us.style.display = "none";

  if (contrasena.value.trim().length <= 2 || contrasena.value.trim() === "") {
    contrasena.focus();
    con.style.display = "";
    return false;
  }

  con.style.display = "none";

  btn.style.display = ""; // Show "Enviando datos" message
  setTimeout(() => frmlogin.submit(), 1000);
}

document.addEventListener("DOMContentLoaded", function () {
  document
    .getElementById("frmempleado")
    .addEventListener("submit", validarempleado);
});
function validarempleado(event) {
  event.preventDefault();

  const frmempleado = document.getElementById("frmempleado");
  const nombre = frmempleado.nombre;
  const apaterno = frmempleado.apaterno;
  const amaterno = frmempleado.amaterno;
  const direccion = frmempleado.direccion;
  const telefono = frmempleado.telefono;
  const correo = frmempleado.correo;
  const rol = frmempleado.rol;

  const no = document.getElementById("no");
  const apat = document.getElementById("apat");
  const amat = document.getElementById("amat");
  const fec = document.getElementById("fec");
  const dir = document.getElementById("dir");
  const tel = document.getElementById("tel");
  const cor = document.getElementById("cor");
  const empre = document.getElementById("empre");

  const btne = document.getElementById("btne");
  // Perform validation
  if (
    nombre.value.trim() === "" ||
    nombre.value.trim().length <= 2 ||
    !expreNomyApe.test(nombre.value)
  ) {
    nombre.focus();
    no.style.display = "";
    return false;
  }
  no.style.display = "none";

  if (
    apaterno.value.trim() === "" ||
    apaterno.value.trim().length <= 2 ||
    !expreNomyApe.test(apaterno.value)
  ) {
    apaterno.focus();
    apat.style.display = "";
    return false;
  }
  apat.style.display = "none";

  if (
    amaterno.value.trim() === "" ||
    amaterno.value.trim().length <= 2 ||
    !expreNomyApe.test(amaterno.value)
  ) {
    amaterno.focus();
    amat.style.display = "";
    return false;
  }
  amat.style.display = "none";

  /**Validar el formato de fecha que corresponda a año, mes y dia */
  const nacimiento = document.getElementById("nacimiento").value;
  if (nacimiento.length == 0 || !patronanio.test(nacimiento)) {
    document.getElementById("nacimiento").focus();
    fec.style.display = "";
    return false;
  }
  fec.style.display = "none";

  if (
    direccion.value.trim() === "" ||
    direccion.value.trim().length <= 10 ||
    !expreDir.test(direccion.value)
  ) {
    direccion.focus();
    dir.style.display = "";
    return false;
  }
  dir.style.display = "none";

  if (
    telefono.value.trim() === "" ||
    telefono.value.trim().length <= 9 ||
    !expreTel.test(telefono.value)
  ) {
    telefono.focus();
    tel.style.display = "";
    return false;
  }
  tel.style.display = "none";

  if (
    correo.value.trim() === "" ||
    correo.value.trim().length <= 10 ||
    !expreEmail.test(correo.value)
  ) {
    correo.focus();
    cor.style.display = "";
    return false;
  }
  cor.style.display = "none";

  if (rol.value.trim() === "" || rol.value.trim().length <= 5) {
    rol.focus();
    empre.style.display = "";
    return false;
  }
  empre.style.display = "none";
  btne.style.display = ""; // Show "Enviando datos" message
  setTimeout(() => frmempleado.submit(), 1000);
}

document.addEventListener("DOMContentLoaded", function () {
  document
    .getElementById("frmubicacion")
    .addEventListener("submit", validarUbicacion);
});

function validarUbicacion(event) {
  // Prevent form submission initially
  event.preventDefault();

  // Access form and elements
  const frmubicacion = document.getElementById("frmubicacion");
  const mueble = frmubicacion.mueble;
  const division1 = frmubicacion.division1;
  const division2 = frmubicacion.division2;
  const division3 = frmubicacion.division3;

  const nom = document.getElementById("nom");
  const div = document.getElementById("div");
  const div2 = document.getElementById("div2");
  const div3 = document.getElementById("div3");
  const btne = document.getElementById("btne");

  // Perform validation
  if (
    mueble.value.trim() === "" ||
    mueble.value.trim().length <= 2 ||
    !expreDir.test(mueble.value)
  ) {
    mueble.focus();
    nom.style.display = "";
    return false;
  }
  nom.style.display = "none";

  if (
    division1.value.trim() === "" ||
    division1.value.trim().length <= 2 ||
    !expreDir.test(division1.value)
  ) {
    division1.focus();
    div.style.display = "";
    return false;
  }
  div.style.display = "none";

  if (division2.value.trim() === "") {
    division2.focus();
    div2.style.display = "";
    return false;
  }
  div2.style.display = "none";

  if (division3.value.trim() === "") {
    division3.focus();
    div3.style.display = "";
    return false;
  }
  div3.style.display = "none";
  btne.style.display = ""; // Show "Enviando datos" message
  setTimeout(() => frmubicacion.submit(), 1000);
}

document.addEventListener("DOMContentLoaded", function () {
  document
    .getElementById("frmproveedor")
    .addEventListener("submit", validarProveedor);
});

function validarProveedor(event) {
  // Prevent form submission initially
  event.preventDefault();

  // Access form and elements
  const frmproveedor = document.getElementById("frmproveedor");
  const nombre = frmproveedor.Nomproveedor;
  const direccion = frmproveedor.direccion;
  const telefono = frmproveedor.telefono;
  const correo = frmproveedor.correo;

  const nomP = document.getElementById("nomP");
  const dir = document.getElementById("dir");
  const tele = document.getElementById("tele");
  const cor = document.getElementById("cor");
  const btne = document.getElementById("btne");

  // Perform validation
  if (
    nombre.value.trim() === "" ||
    nombre.value.trim().length <= 2 ||
    !expreDir.test(nombre.value)
  ) {
    nombre.focus();
    nomP.style.display = "";
    return false;
  }
  nomP.style.display = "none";

  if (
    direccion.value.trim() === "" ||
    direccion.value.trim().length <= 2 ||
    !expreDir.test(direccion.value)
  ) {
    direccion.focus();
    dir.style.display = "";
    return false;
  }
  dir.style.display = "none";

  if (
    telefono.value.trim() === "" ||
    telefono.value.trim().length <= 9 ||
    !expreTel.test(telefono.value)
  ) {
    telefono.focus();
    tele.style.display = "";
    return false;
  }
  tele.style.display = "none";

  if (correo.value.trim() === "") {
    correo.focus();
    cor.style.display = "";
    return false;
  }
  cor.style.display = "none";

  btne.style.display = ""; // Show "Enviando datos" message
  setTimeout(() => frmproveedor.submit(), 1000);
}

document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("frmcolor").addEventListener("submit", validarColor);
});

function validarColor(event) {
  // Prevent form submission initially
  event.preventDefault();

  // Access form and elements
  const frmcolor = document.getElementById("frmcolor");
  const nombre = frmcolor.nombre;
  const nom = document.getElementById("nom");
  const btne = document.getElementById("btne");

  // Perform validation
  if (nombre.value.trim() === "") {
    nombre.focus();
    nom.style.display = "";
    return false;
  }
  nom.style.display = "none";

  btne.style.display = ""; // Show "Enviando datos" message
  setTimeout(() => frmcolor.submit(), 1000);
}

document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("frmmarca").addEventListener("submit", validarMarca);
});

function validarMarca(event) {
  // Prevent form submission initially
  event.preventDefault();

  // Access form and elements
  const frmmarca = document.getElementById("frmmarca");
  const nombre = frmmarca.nombre;
  const nom = document.getElementById("nom");
  const btne = document.getElementById("btne");

  // Perform validation
  if (nombre.value.trim() === "") {
    nombre.focus();
    nom.style.display = "";
    return false;
  }
  nom.style.display = "none";

  btne.style.display = ""; // Show "Enviando datos" message
  setTimeout(() => frmmarca.submit(), 1000);
}

document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("frmMate").addEventListener("submit", validarMate);
});

function validarMate(event) {
  // Prevent form submission initially
  event.preventDefault();

  // Access form and elements
  const frmMate = document.getElementById("frmMate");
  const nombre = frmMate.nombre;
  const nom = document.getElementById("nom");
  const btne = document.getElementById("btne");

  // Perform validation
  if (nombre.value.trim() === "") {
    nombre.focus();
    nom.style.display = "";
    return false;
  }
  nom.style.display = "none";

  btne.style.display = ""; // Show "Enviando datos" message
  setTimeout(() => frmMate.submit(), 1000);
}

document.addEventListener("DOMContentLoaded", function () {
  document
    .getElementById("frmSubmate")
    .addEventListener("submit", validarSubmate);
});

function validarSubmate(event) {
  // Prevent form submission initially
  event.preventDefault();

  // Access form and elements
  const frmSubmate = document.getElementById("frmSubmate");
  const nombre = frmSubmate.nombre;
  const nom = document.getElementById("nom");
  const btne = document.getElementById("btne");

  // Perform validation
  if (nombre.value.trim() === "") {
    nombre.focus();
    nom.style.display = "";
    return false;
  }
  nom.style.display = "none";

  btne.style.display = ""; // Show "Enviando datos" message
  setTimeout(() => frmSubmate.submit(), 1000);
}

document.addEventListener("DOMContentLoaded", function () {
  document
    .getElementById("frmacabado")
    .addEventListener("submit", validarAcabado);
});

function validarAcabado(event) {
  // Prevent form submission initially
  event.preventDefault();

  // Access form and elements
  const frmacabado = document.getElementById("frmacabado");
  const nombreA = frmacabado.nombreA;
  const nomA = document.getElementById("nomA");
  const btne = document.getElementById("btne");

  // Perform validation
  if (nombreA.value.trim() === "") {
    nombreA.focus();
    nomA.style.display = "";
    return false;
  }
  nomA.style.display = "none";

  btne.style.display = ""; // Show "Enviando datos" message
  setTimeout(() => frmacabado.submit(), 1000);
}



document.addEventListener("DOMContentLoaded", function () {
  document
    .getElementById("frmgrosor")
    .addEventListener("submit", validarGrosor);
});

function validarGrosor(event) {
  // Prevent form submission initially
  event.preventDefault();

  // Access form and elements
  const frmgrosor = document.getElementById("frmgrosor");
  const cantGrosor = frmgrosor.cantGrosor;
  const unidadMedida = frmgrosor.unidadMedida;
  const flexibilidad = frmgrosor.flexibilidad;

  const can = document.getElementById("can");
  const uni = document.getElementById("uniM");
  const flex = document.getElementById("flex");
  const btne = document.getElementById("btne");

  // Perform validation
  if (cantGrosor.value.trim() === "") {
    cantGrosor.focus();
    can.style.display = "";
    return false;
  }
  can.style.display = "none";

  if (unidadMedida.value.trim() === "") {
    unidadMedida.focus();
    uni.style.display = "";
    return false;
  }
  uni.style.display = "none";

  if (flexibilidad.value.trim() === "") {
    flexibilidad.focus();
    flex.style.display = "";
    return false;
  }
  flex.style.display = "none";

  btne.style.display = ""; // Show "Enviando datos" message
  setTimeout(() => frmgrosor.submit(), 1000);
}

document.addEventListener("DOMContentLoaded", function () {
  document
    .getElementById("frminsumo")
    .addEventListener("submit", validarInsumo);
});

function validarInsumo(event) {
  // Prevent form submission initially
  event.preventDefault();

  // Access form and elements
  const frminsumo = document.getElementById("frminsumo");
  const nomInsumo = frminsumo.nomInsumo;
  const fechacompra = frminsumo.fechacompra;
  const fechauso = frminsumo.fechauso;
  const cantidad = frminsumo.cantidad;
  const rendimiento = frminsumo.rendimiento;
  const precio = frminsumo.precio;
  const disponibilidad = frminsumo.disponibilidad;
  const idubicacion = frminsumo.idubicacion;
  const idcolor = frminsumo.idcolor;
  const idtransparencia = frminsumo.idtransparencia;
  const idacabado = frminsumo.idacabado;
  const idpresentacion = frminsumo.idpresentacion;
  const idtipomedida = frminsumo.idtipomedida;
  const idmedida = frminsumo.idmedida;
  const idgrosor = frminsumo.idgrosor;
  const idmaterial = frminsumo.idmaterial;
  const idproveedor = frminsumo.idproveedor;
  const idmarca = frminsumo.idmarca;
  const idsubmaterial = frminsumo.idsubmaterial;

  const ins = document.getElementById("ins");
  const fec = document.getElementById("fec");
  const fecus = document.getElementById("fecus");
  const canti = document.getElementById("canti");
  const rendi = document.getElementById("rendi");
  const prec = document.getElementById("prec");
  const dis = document.getElementById("dis");
  const sub = document.getElementById("sub");
  const mar = document.getElementById("mar");
  const pro = document.getElementById("pro");
  const mat = document.getElementById("mat");
  const gro = document.getElementById("gro");
  const med = document.getElementById("med");
  const tmed = document.getElementById("tmed");
  const pres = document.getElementById("pres");
  const aca = document.getElementById("aca");
  const trans = document.getElementById("trans");
  const col = document.getElementById("col");
  const ubi = document.getElementById("ubi");

  const btne = document.getElementById("btne");

  // Perform validation
  if (nomInsumo.value.trim() === "") {
    nomInsumo.focus();
    ins.style.display = "";
    return false;
  }
  ins.style.display = "none";

  if (fechacompra.value.trim() === "") {
    fechacompra.focus();
    fec.style.display = "";
    return false;
  }
  fec.style.display = "none";

  if (fechauso.value.trim() === "") {
    fechauso.focus();
    fecus.style.display = "";
    return false;
  }
  fecus.style.display = "none";

  if (fechauso.value.trim() === "") {
    fechauso.focus();
    fecus.style.display = "";
    return false;
  }
  fecus.style.display = "none";

  if (cantidad.value.trim() === "") {
    cantidad.focus();
    canti.style.display = "";
    return false;
  }
  canti.style.display = "none";

  if (rendimiento.value.trim() === "") {
    rendimiento.focus();
    rendi.style.display = "";
    return false;
  }
  rendi.style.display = "none";

  if (precio.value.trim() === "") {
    precio.focus();
    prec.style.display = "";
    return false;
  }
  prec.style.display = "none";

  if (disponibilidad.value.trim() === "") {
    disponibilidad.focus();
    dis.style.display = "";
    return false;
  }
  dis.style.display = "none";

  if (idubicacion.value.trim() === "") {
    idubicacion.focus();
    ubi.style.display = "";
    return false;
  }
  ubi.style.display = "none";

  if (idacabado.value.trim() === "") {
    idacabado.focus();
    aca.style.display = "";
    return false;
  }
  aca.style.display = "none";

  if (idcolor.value.trim() === "") {
    idcolor.focus();
    col.style.display = "";
    return false;
  }
  col.style.display = "none";

  if (idgrosor.value.trim() === "") {
    idgrosor.focus();
    gro.style.display = "";
    return false;
  }
  gro.style.display = "none";

  if (idmarca.value.trim() === "") {
    idmarca.focus();
    mar.style.display = "";
    return false;
  }
  mar.style.display = "none";

  if (idmedida.value.trim() === "") {
    idmedida.focus();
    med.style.display = "";
    return false;
  }
  med.style.display = "none";

  if (idmaterial.value.trim() === "") {
    idmaterial.focus();
    mat.style.display = "";
    return false;
  }
  mat.style.display = "none";

  if (idpresentacion.value.trim() === "") {
    idpresentacion.focus();
    pres.style.display = "";
    return false;
  }
  pres.style.display = "none";

  if (idproveedor.value.trim() === "") {
    idproveedor.focus();
    pro.style.display = "";
    return false;
  }
  pro.style.display = "none";

  if (idsubmaterial.value.trim() === "") {
    idsubmaterial.focus();
    sub.style.display = "";
    return false;
  }
  sub.style.display = "none";

  if (idtipomedida.value.trim() === "") {
    idtipomedida.focus();
    tmed.style.display = "";
    return false;
  }
  tmed.style.display = "none";

  if (idtransparencia.value.trim() === "") {
    idtransparencia.focus();
    trans.style.display = "";
    return false;
  }
  trans.style.display = "none";

  btne.style.display = ""; // Show "Enviando datos" message
  setTimeout(() => frminsumo.submit(), 1000);
}

document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("frmbaja").addEventListener("submit", validarBaja);
});

function validarBaja(event) {
  // Prevent form submission initially
  event.preventDefault();

  // Access form and elements
  const frmbaja = document.getElementById("frmbaja");

  const cantidad = frmbaja.cantBaja;
  const fechabaja = frmbaja.fechabaja;
  const motivo = frmbaja.motivo;
  const idinsumos = frmbaja.idinsumos;
  const idempleado = frmbaja.idempleado;

  const canti = document.getElementById("cant");
  const fecha = document.getElementById("fecha");
  const mot = document.getElementById("mot");
  const insu = document.getElementById("insu");
  const emp = document.getElementById("emp");

  const btne = document.getElementById("btne");

  // Perform validation
  if (cantidad.value.trim() === "") {
    cantidad.focus();
    canti.style.display = "";
    return false;
  }
  canti.style.display = "none";

  if (fechabaja.value.trim() === "") {
    fechabaja.focus();
    fecha.style.display = "";
    return false;
  }
  fecha.style.display = "none";

  if (motivo.value.trim() === "") {
    motivo.focus();
    mot.style.display = "";
    return false;
  }
  mot.style.display = "none";

  if (idinsumos.value.trim() === "") {
    idinsumos.focus();
    insu.style.display = "";
    return false;
  }
  insu.style.display = "none";

  if (idempleado.value.trim() === "") {
    idempleado.focus();
    emp.style.display = "";
    return false;
  }
  emp.style.display = "none";

  btne.style.display = ""; // Show "Enviando datos" message
  setTimeout(() => frmbaja.submit(), 1000);
}

document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("frmPrese")
    .addEventListener("submit", validarPresentacion);
});

function validarPresentacion(event) {
  // Prevent form submission initially
  event.preventDefault();

  // Access form and elements
  const frmPrese = document.getElementById("frmPrese");
  const nombre = frmPrese.nombre;

  const nom = document.getElementById("nom");
  const btne = document.getElementById("btne");

  // Perform validation
  if (nombre.value.trim() === "") {
    nombre.focus();
    nom.style.display = "";
    return false;
  }
  nom.style.display = "none";

  btne.style.display = ""; // Show "Enviando datos" message
  setTimeout(() => frmPrese.submit(), 1000);
}

document.addEventListener("DOMContentLoaded", function () {
  document
    .getElementById("frmMedida")
    .addEventListener("submit", validarMedida);
});

function validarMedida(event) {
  // Prevent form submission initially
  event.preventDefault();

  // Access form and elements
  const frmMedida = document.getElementById("frmMedida");
  const largo = frmMedida.largo;
  const ancho = frmMedida.ancho;

  const lar = document.getElementById("lar");
  const an = document.getElementById("an");
  const btne = document.getElementById("btne");

  // Perform validation
  if (largo.value.trim() === "") {
    largo.focus();
    lar.style.display = "";
    return false;
  }
  lar.style.display = "none";

  if (ancho.value.trim() === "") {
    ancho.focus();
    an.style.display = "";
    return false;
  }
  an.style.display = "none";

  btne.style.display = ""; // Show "Enviando datos" message
  setTimeout(() => frmMedida.submit(), 1000);
}

document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("frmTmedida")
    .addEventListener("submit", validarTipomedida);
});

function validarTipomedida(event) {
  // Prevent form submission initially
  event.preventDefault();

  // Access form and elements
  const frmTmedida = document.getElementById("frmTmedida");
  const nombreT = frmTmedida.nombreT;
  const unidadT = frmTmedida.unidad;

  const nomT = document.getElementById("nomT");
  const unid = document.getElementById("uni");
  const btne = document.getElementById("btne");

  // Perform validation
  if (nombreT.value.trim() === "") {
    nombreT.focus();
    nomT.style.display = "";
    return false;
  }
  nomT.style.display = "none";

  if (unidadT.value.trim() === "") {
    unidadT.focus();
    unid.style.display = "";
    return false;
  }
  unid.style.display = "none";

  btne.style.display = ""; // Show "Enviando datos" message
  setTimeout(() => frmTmedida.submit(), 1000);
}

document.addEventListener("DOMContentLoaded", function () {
  document
    .getElementById("frmTransparencia")
    .addEventListener("submit", validarTransparencia);
});

function validarTransparencia(event) {
  // Prevent form submission initially
  event.preventDefault();

  // Access form and elements
  const frmTransparencia = document.getElementById("frmTransparencia");
  const nombre = frmTransparencia.nombreT;

  const nom = document.getElementById("nom");
  const btne = document.getElementById("btne");

  // Perform validation
  if (nombre.value.trim() === "") {
    nombre.focus();
    nom.style.display = "";
    return false;
  }
  nom.style.display = "none";

  btne.style.display = ""; // Show "Enviando datos" message
  setTimeout(() => frmTransparencia.submit(), 1000);
}


function validarestado() {
  if (
    document.frmestado.estado.value.trim().length <= 2 ||
    document.frmestado.estado.value.length == 0
  ) {
    document.getElementById("estado").focus();
    est.style.display = "";
    return false;
  }

  est.style.display = "none";

  btn.style.display = "";

  frmestado.submit();
}

function validarprodFinal() {
  if (
    document.frmprod.nombre.value.trim().length <= 2 ||
    document.frmprod.nombre.value.length == 0
  ) {
    document.getElementById("nombre").focus();
    prod.style.display = "";
    return false;
  }

  prod.style.display = "none";

  if (document.frmprod.precio.value.length == 0) {
    document.getElementById("precio").focus();
    prec.style.display = "";
    return false;
  }

  prec.style.display = "none";

  btne.style.display = "";

  frmprod.submit();
}

function validarPedido() {
  if (document.frmpedido.cant.value.length == 0) {
    document.getElementById("cant").focus();
    can.style.display = "";
    return false;
  }

  can.style.display = "none";

  if (
    document.frmpedido.nombrecliente.value.trim().length <= 2 ||
    document.frmpedido.nombrecliente.value.length == 0 ||
    !expreNomyApe.test(document.frmpedido.nombrecliente.value)
  ) {
    document.getElementById("nombrecliente").focus();
    nombc.style.display = "";
    return false;
  }

  nombc.style.display = "none";

  const fecha = document.getElementById("fechaPedido").value;
  if (
    document.frmpedido.fechaPedido.value.length == 0 ||
    !patronanio.test(fecha)
  ) {
    document.getElementById("fechaPedido").focus();
    fechap.style.display = "";
    return false;
  }

  fechap.style.display = "none";

  if (document.frmpedido.idproductoFinal.value.length == 0) {
    document.getElementById("idproductoFinal").focus();
    producto.style.display = "";
    return false;
  }

  producto.style.display = "none";

  if (document.frmpedido.idestado.value.length == 0) {
    document.getElementById("idestado").focus();
    estado.style.display = "";
    return false;
  }

  estado.style.display = "none";

  btn.style.display = "";

  frmpedido.submit();
}

function validarDetalle() {
  if (document.frmdetalle.descuento.value.length == 0) {
    document.getElementById("descuento").focus();
    desc.style.display = "";
    return false;
  }

  desc.style.display = "none";

  if (document.frmdetalle.subtotal.value.length == 0) {
    document.getElementById("subtotal").focus();
    sub.style.display = "";
    return false;
  }

  sub.style.display = "none";

  if (document.frmdetalle.iva.value.length == 0) {
    document.getElementById("iva").focus();
    iv.style.display = "";
    return false;
  }

  iv.style.display = "none";

  if (document.frmdetalle.total.value.length == 0) {
    document.getElementById("total").focus();
    tot.style.display = "";
    return false;
  }

  tot.style.display = "none";

  if (document.frmdetalle.serie.value.length == 0) {
    document.getElementById("serie").focus();
    ped.style.display = "";
    return false;
  }

  ped.style.display = "none";

  btn.style.display = "";

  frmdetalle.submit();
}

document.addEventListener("DOMContentLoaded", function () {
  // Obtener el botón de cierre
  const closeButton = document.getElementById("closeButton");

  // Obtener el contexto de la vista
  const context = document.body.getAttribute("data-context");

  // Verificar si el botón y el contexto existen
  if (closeButton && context) {
    closeButton.addEventListener("click", function () {
      // Redirigir a la vista correspondiente según el contexto
      switch (context) {
        case "registroUbicacion":
          window.location.href = "../Vista/registroUbicacion.php";
          break;
        case "registroMarca":
          window.location.href = "../Vista/registrarMarca.php";
          break;
        case "registroMaterial":
          window.location.href = "../Vista/registrarMaterial.php";
          break;
        case "registroProveedor":
          window.location.href = "../Vista/registrarProveedor.php";
          break;
        case "registroSubMaterial":
          window.location.href = "../Vista/registrarSubMaterial.php";
          break;
        case "registroAcabadoSuperficial":
          window.location.href = "../Vista/registroAcabadoSuperficial.php";
          break;
        case "registroBaja":
          window.location.href = "../Vista/registroBaja.php";
          break;
        case "registroColor":
          window.location.href = "../Vista/registroColor.php";
          break;
        case "registroEmpleado":
          window.location.href = "../Vista/registroEmpleado.php";
          break;
          case "editarEmpleado":
            window.location.href = "../Vista/editarEmpleado.php";
            break;
        case "registroGrosor":
          window.location.href = "../Vista/registroGrosor.php";
          break;
        case "registroInsumo":
          window.location.href = "../Vista/registroInsumo.php";
          break;
        case "registroMedida":
          window.location.href = "../Vista/registroMedida.php";
          break;
        case "registroTipoMedida":
          window.location.href = "../Vista/registroTipoMedida.php";
          break;
        case "registroPresentacion":
          window.location.href = "../Vista/registroPresentacion.php";
          break;
        case "registroTransparencia":
          window.location.href = "../Vista/registroTransparencia.php";
          break;
        case "registroDetalle":
          window.location.href = "../Vista/registroDetalle.php";
          break;
        case "registroUsuario":
          window.location.href = "../Vista/registroUsuario.php";
          break;
        // Agrega más casos según sea necesario
        default:
          console.error("Contexto desconocido:", context);
          break;
      }
    });
  }
});

document.addEventListener("DOMContentLoaded", function () {
  // Seleccionar todos los elementos <select> con la clase "registro-select"
  const registroSelects = document.querySelectorAll(".registro-select");

  // Iterar sobre cada lista desplegable
  registroSelects.forEach((select) => {
    select.addEventListener("change", function () {
      const selectedValue = this.value;
      const registroUrl = this.dataset.registroUrl; // Obtener la URL de registro del atributo data-registro-url

      if (selectedValue === "registro") {
        // Redirigir a la URL de registro si se selecciona "Agregar nueva"
        window.location.href = registroUrl;
      }
    });
  });
});


function validarFormulario() {
    const archivoRespaldo = document.getElementById('archivoRespaldo').value;
    if (archivoRespaldo === '') {
        alert('Por favor, seleccione un archivo de respaldo para restaurar.');
        return false;
    }
    return true;
}


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>