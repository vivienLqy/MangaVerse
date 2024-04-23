import React from "react";
import { NavLink } from "react-router-dom";
import Logo from "../assets/Logo.svg";
import FormConnexion from "../components/forms/FormConnexion";

const Connexion = () => {
  return (
    <div className="bg-bgTest h-full flex justify-center items-center">
      <FormConnexion />
    </div>
  );
};

export default Connexion;
