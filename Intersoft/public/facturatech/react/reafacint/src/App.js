import React from "react";
import {
  BrowserRouter as Router,
  Switch,
  Route,
  Link
} from "react-router-dom";

import EmpresasComponent from "../src/empresas";

export default function App() {
  return (
    <Router>
      <div>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
          <div class="container">
              <a class="navbar-brand js-scroll-trigger" href="/">Intercon Facturatech</a><button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
              <div class="collapse navbar-collapse" id="navbarResponsive">
                  <ul class="navbar-nav ml-auto my-2 my-lg-0">
                      <li class="nav-item"><a class="nav-link js-scroll-trigger" href="/about">App</a></li>
                      <li class="nav-item"><a class="nav-link js-scroll-trigger" href="/services">Servicios</a></li>
                      <li class="nav-item"><a class="nav-link js-scroll-trigger" href="/contact">Contacto</a></li>
                  </ul>
              </div>
          </div>
        </nav>

        {/* A <Switch> looks through its children <Route>s and
            renders the first one that matches the current URL. */}
        <Switch>
          <Route path="/about">
            <About />
            <SectionAbout></SectionAbout>
            <SectionDescargar></SectionDescargar>
          </Route>
          <Route path="/services">
            <Servicios />
            <SectionServicios></SectionServicios>
            <SectionDescargar></SectionDescargar>
          </Route>
          <Route path="/contact">
            <Contactos />
            <SectionContactos></SectionContactos>
          </Route>
          <Route path="/empresas"> 
            <Empresas />
            <EmpresasComponent></EmpresasComponent>
          </Route>
          <Route path="/">
            <Home />
            <SectionAbout></SectionAbout>
            <SectionServicios></SectionServicios>
            <SectionDescargar></SectionDescargar>
            <SectionContactos></SectionContactos>
          </Route>
        </Switch>
      </div>
    </Router>
  );
}

function Home() {
  return <Header name="INTERCON"></Header>;
}

function About() {
  return <Header name="App"></Header>;
}

function Servicios() {
  return <Header name="Servicios"></Header>;
}

function Contactos() {
  return <Header name="Contactos"></Header>;
}

function Empresas() {
  return <Header name="Elige la empresa a consultar"></Header>;
}

function Header({name}){
  return <header class="masthead">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-10 align-self-end">
              <h1 class="text-uppercase text-white font-weight-bold">{name}</h1>
                <hr class="divider my-4" />
            </div>
            <div class="col-lg-8 align-self-baseline">
                <p class="text-white-75 font-weight-light mb-5">Complemento de integrador DIAN, Facturatech. <br/>
                Busca Facturas creadas desde Intercon subidas con el integrador</p>
            </div>
        </div>
    </div>
  </header>;
}

function SectionAbout(){
  return <section class="page-section bg-primary" id="about">
          <div class="container">
              <div class="row justify-content-center">
                  <div class="col-lg-8 text-center">
                      <h2 class="text-white mt-0">Queremos que puedas acceder a las faturas emitidas a la DIAN por el integrador desde cualquier lugar y cualquier dispositivo</h2>
                      <hr class="divider light my-4" />
                      <p class="text-white-50 mb-4">
                      Por ello creamos este espacio donde podrás descargar las facturas emitidas.</p>
                      <a class="btn btn-light btn-xl js-scroll-trigger" href="/empresas">Empecemos!</a>
                  </div>
              </div>
          </div>
      </section>;
}

function SectionServicios(){
  return <section class="page-section" id="services">
  <div class="container">
      <h2 class="text-center mt-0">Nuestros Servicios</h2>
      <hr class="divider my-4" />
      <div class="row">
          <div class="col-lg-3 col-md-6 text-center">
              <div class="mt-5">
              </div>
          </div>
          <div class="col-lg-3 col-md-6 text-center">
              <div class="mt-5">
                  <i class="fas fa-4x fa-gem text-primary mb-4"></i>
                  <h3 class="h4 mb-2">Buscar Facturas</h3>
                  <p class="text-muted mb-0">Busca todas las facturas emitidas</p>
              </div>
          </div>
          <div class="col-lg-3 col-md-6 text-center">
              <div class="mt-5">
                  <i class="fas fa-4x fa-laptop-code text-primary mb-4"></i>
                  <h3 class="h4 mb-2">Reporte De Facturas</h3>
                  <p class="text-muted mb-0">Generamos reportes estadisticos a partir de las emisiones de las facturas</p>
              </div>
          </div>
          <div class="col-lg-3 col-md-6 text-center">
              <div class="mt-5">
              </div>
          </div>
      </div>
  </div>
</section>;

}


function SectionContactos(){
  return <section class="page-section" id="contact">
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-lg-8 text-center">
              <h2 class="mt-0">Contacta con nosotros</h2>
              <hr class="divider my-4" />
              <p class="text-muted mb-5">¿Quieres generar facturas electronicas aprobadas con la DIAN?, comunicate con nosotros para poder lograrlo</p>
          </div>
      </div>
      <div class="row">
          <div class="col-lg-4 ml-auto text-center mb-5 mb-lg-0">
              <i class="fas fa-phone fa-3x mb-3 text-muted"></i>
              <div>311 506 50 24</div>
          </div>
          <div class="col-lg-4 mr-auto text-center">
              <i class="fas fa-envelope fa-3x mb-3 text-muted"></i>
              <a class="d-block" href="mailto:interconsis@yahoo.com">interconsis@yahoo.com</a>
          </div>
      </div>
  </div>
</section>;
}

function SectionDescargar(){
  return <section class="page-section bg-dark text-white">
  <div class="container text-center">
      <h2 class="mb-4">Descarga la Aplicación en play store</h2>
      <a class="btn btn-light btn-xl" href="/empresas">Descargar ahora!</a>
  </div>
</section>;
}
