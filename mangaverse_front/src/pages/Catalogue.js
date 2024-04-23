import { useState, useEffect } from "react";
import axios from "axios";
import CardProduit from "../components/CardProduit";

const Catalogue = () => {
  const [oeuvres, setOeuvres] = useState([]);

  useEffect(() => {
    axios
      .get("http://localhost:8000/api/oeuvres", {
        headers: {
          Authorization: `bearer ${localStorage.getItem("token")}`,
        },
      })
      .then((res) => {
        setOeuvres(res.data);
        // setProduits(res.data["hydra:member"]);
        console.log(res);
      })
      .catch((error) => {
        console.error(
          "Une erreur s'est produite lors de la récupération des produits : ",
          error
        );
      });
  }, []);

  return (
    <div className="h-full bg-bleuDark">
      <div className="w-full bg-white flex justify-center ">
        <div className=" py-2">
          <input
            className=" borderLavande rounded-md text-center "
            type="search"
            id="search"
            placeholder="Titre"
          />
          <button className=" borderLavande rounded-md w-20">Genres</button>
        </div>
      </div>
      <div className="w-full flex justify-center flex-row text-center text-white pt-10">
        <div className="grid sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
          {oeuvres ? (
            oeuvres.map((oeuvre, index) => (
              <CardProduit oeuvre={oeuvre} key={index} />
            ))
          ) : (
            <p>Chargement en cours...</p>
          )}
        </div>
      </div>
    </div>
  );
};

export default Catalogue;
