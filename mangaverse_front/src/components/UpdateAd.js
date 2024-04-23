// UpdateAdmin.js
import React from 'react';

const UpdateAd = ({ product }) => {
    return (
        <div>
            <div className="w-full flex justify-center">
                <div className="bg-blackOP30 w-10/12 my-10">
                    <input type="text" placeholder="Oeuvres :" className="bg-transparent w-full" />
                </div>
                <div className="flex flex-row">
                    <div>
                        <img
                            src={`/img/manga/${product.oeuvres?.id.replace(/\s+/g, "").toLowerCase()}/${product.picture}`}
                            alt={product.name}
                            className="h-64 w-full"
                        />
                    </div>
                </div>
            </div>
        </div>
    );
};

export default UpdateAd;
