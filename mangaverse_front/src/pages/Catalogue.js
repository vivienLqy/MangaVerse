import React, { useState, useEffect } from "react";
import axios from "axios";
import CardProduit from "../components/CardProduit";

const Catalogue = () => {
  const [oeuvres, setOeuvres] = useState([]);
  const [genres, setGenres] = useState([]);
  const [selectedGenre, setSelectedGenre] = useState(null);
  const [showDropdown, setShowDropdown] = useState(false);

  useEffect(() => {
    axios
      .get("http://localhost:8000/api/oeuvres", {
        headers: {
          Authorization: `bearer ${localStorage.getItem("token")}`,
        },
      })
      .then((res) => {
        setOeuvres(res.data);
      })
      .catch((error) => {
        console.error("Une erreur s'est produite lors de la récupération des oeuvres : ", error);
      });

    axios
      .get("http://localhost:8000/api/genres", {
        headers: {
          Authorization: `bearer ${localStorage.getItem("token")}`,
        },
      })
      .then((res) => {
        setGenres(res.data);
      })
      .catch((error) => {
        console.error("Une erreur s'est produite lors de la récupération des genres : ", error);
      });
  }, []);

  const handleDropdownToggle = () => {
    setShowDropdown(!showDropdown);
  };

  const handleGenreSelect = (genre) => {
    setSelectedGenre(genre);
    setShowDropdown(false);
  };

  const handleShowAll = () => {
    setSelectedGenre(null);
    setShowDropdown(false);
  };

  const filteredOeuvres = selectedGenre
    ? oeuvres.filter((oeuvre) =>
      oeuvre.genres.some((genre) => genre.name === selectedGenre.name)
    )
    : oeuvres;

  return (
    <div className="h-full bg-bleuDark">
      <div className="w-full bg-white flex justify-center">
        <div className="py-2 relative">
          <input
            className="borderLavande rounded-md text-center"
            type="search"
            id="search"
            placeholder="Titre"
          />
          <div className="relative inline-block text-left">
            <div>
              <button
                type="button"
                onClick={handleDropdownToggle}
                className="inline-flex justify-center px-2 w-full rounded-md borderLavande focus:outline-none"
                id="dropdownMenuButton"
              >
                Genres
              </button>
            </div>
            {showDropdown && (
              <div className="origin-top-right absolute right-0 mt-2 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none  max-h-48 overflow-y-auto">
                <div className="py-1">
                  <div
                    onClick={handleShowAll}
                    className="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                  >
                    Tous
                  </div>
                  {genres ? (
                    genres.map((genre, index) => (
                      <div
                        key={index}
                        onClick={() => handleGenreSelect(genre)}
                        className="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                      >
                        {genre.name}
                      </div>
                    ))
                  ) : (
                    <p className="block px-4 py-2 text-sm text-gray-700">Chargement en cours...</p>
                  )}
                </div>
              </div>
            )}
          </div>
        </div>
      </div>
      <div className="w-full flex justify-center flex-row text-center text-white pt-10">
        <div className="grid sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
          {filteredOeuvres ? (
            filteredOeuvres.map((oeuvre, index) => (
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
