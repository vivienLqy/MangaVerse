import React from "react";
import { NavLink } from "react-router-dom";

const CardProduit = ({ oeuvre }) => {
  return (
    <div className="w-52 flex flex-col items-center">
      <NavLink to={`/monproduit/${oeuvre.id}`} className="justify-center">
        <img
          src={`img/manga/${oeuvre.name.replace(/\s+/g, "").toLowerCase()}/${oeuvre.picture}`}
          alt={oeuvre.name}
          className="h-52"
        />
      </NavLink>
      <p className="mt-2 text-center">
        <strong>{oeuvre.name}</strong>
      </p>
    </div>
  );

};
export default CardProduit;
