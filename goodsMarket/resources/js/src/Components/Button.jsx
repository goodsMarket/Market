import React from "react";
import styled, { css } from "styled-components";

const StyledButton = styled.button`
    border-radius: 10px;
    font-size: 1.2rem;
    font-weight: bold;
    color: #ffffff;
    width: 150px;
    height: 50px;
    background-color: #00AACF;

    &:hover {
        background-color: #007799;
        transition: 0.2s;
        box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
    }

    ${(props) =>
        props.primary &&
        css`
        `}
    `;

function Button({ children, ...props }) {
    return <StyledButton {...props}>{children}</StyledButton>;
}

export default Button;