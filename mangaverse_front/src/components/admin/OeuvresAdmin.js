import React from "react";
import Update from "../../assets/update.svg";
import Delete from "../../assets/delete.svg";
import { NavLink } from "react-router-dom";

const OeuvresAdmin = ({ oeuvre }) => {
  return (
    <div className=" w-full py-1 bg-blackOP30 mt-1 ">
      <ul className="grid grid-cols-1 text-white">
        <li className="flex justify-between items-center">
          {oeuvre.name}
          <div className="flex w-12 gap-3">
            <NavLink to={`/dashboard/update/oeuvre/${oeuvre.id}`}>
              <img src={Update} alt="logoUpdate" />
            </NavLink>
            <NavLink to={`/dashboard/delete/${oeuvre.id}`}>
              <img src={Delete} alt="logoUpdate" />
            </NavLink>
          </div>
        </li>
      </ul>
    </div>
  );
};

export default OeuvresAdmin;
